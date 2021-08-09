<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request) {
        $user_json = json_decode($request->getContent());
        $user_exist = User::where('email', $user_json->email)->first();
        if ($user_exist) {
            return response()->json(['status' => 'ERROR',
                'code' => '01',
                'message' => 'User Already Exist With Email '.$user_json->email,
            ]);
        }
        $key = env('JWT_KEY');
        $payload = array(
            "iss" => env('JWT_ISSUER'),
            "name" => $user_json->name,
            "email" => $user_json->email,
        );
        $jwt = JWT::encode($payload, $key);
        $user = new User;
        $user->name = $user_json->name;
        $user->email = $user_json->email;
        $user->password = Hash::make($user_json->password);
        $user->token_bearer = $jwt;
        $user->status = 1;
        $user->save();
        return response()->json(['status' => 'SUCCESS',
            'code' => '00',
            'message' => 'User Created',
        ]);
    }

    public function login(Request $request) {
        $body = $request->json()->all();
        $user = User::userByEmail($body['email']);
        if(Hash::check($body['password'],$user->password)) {
            return response()->json(['status' => 'SUCCESS',
                'code' => '00',
                'message' => 'User Valid',
                'payload' => $user->makeVisible('token_bearer'),
            ]);
        } else {
            return response()->json(['status' => 'ERROR',
                'code' => '01',
                'message' => 'User Invalid',
            ]);
        }
    }

    public function profile(Request $request) {
        $key = env('JWT_KEY');
        $jwt = JWT::decode($request->bearerToken(), $key, array('HS256'));
        $user = User::where('email', $jwt->email)->first();
        return response()->json(['status' => 'SUCCESS',
            'code' => '00',
            'message' => 'My Profile',
            'payload' => $user->makeVisible('token_bearer'),
        ]);
    }

    public function update_user(Request $request, $id) {
        $body = $request->json()->all();
        $user = User::find($id);
        if (!$user) {
            return response()->json(['status' => 'ERROR',
                'code' => '01',
                'message' => 'Cant Find User',
            ]);
        }
        $key = env('JWT_KEY');
        $payload = array(
            "iss" => env('JWT_ISSUER'),
            "name" => $body['name'],
            "email" => $body['email'],
        );
        $jwt = JWT::encode($payload, $key);
        $user->name = $body['name'];
        $user->email = $body['email'];
        $user->password = Hash::make($body['password']);
        $user->status = $body['status'];
        $user->token_bearer = $jwt;
        $user->save();
        return response()->json(['status' => 'SUCCESS',
            'code' => '00',
            'message' => 'User Updated',
            'payload' => $user,
        ]);
    }

    public function all_users() {
        $user = User::get();
        return response()->json(['status' => 'SUCCESS',
            'code' => '00',
            'message' => 'List of Users',
            'payload' => $user,
        ]);
    }
}
