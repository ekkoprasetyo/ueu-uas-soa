<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;

class AbsensiController extends Controller
{
    public function create(Request $request) {
        $body = json_decode($request->getContent());
        $key = env('JWT_KEY');
        $jwt = JWT::decode($request->bearerToken(), $key, array('HS256'));
        $user = User::where('email', $jwt->email)->first();
        $absensi = new Absensi;
        $absensi->date = $body->date;
        $absensi->user_id = $user->id;
        $absensi->status = $body->status;
        $absensi->created_at = date('Y-m-d H:i:s');
        $absensi->save();
        return response()->json(['status' => 'SUCCESS',
            'code' => '00',
            'message' => 'Absensi Saved',
        ]);
    }

    public function list_absensi(Request $request) {
        $key = env('JWT_KEY');
        $jwt = JWT::decode($request->bearerToken(), $key, array('HS256'));
        $user = User::where('email', $jwt->email)->first();
        $absensi = Absensi::my_absensi($user->id);
        if($absensi) {
            return response()->json(['status' => 'SUCCESS',
                'code' => '00',
                'message' => 'My Absensi',
                'payload' => $absensi,
            ]);
        } else {
            return response()->json(['status' => 'ERROR',
                'code' => '01',
                'message' => 'My Absensi No Data',
            ]);
        }
    }
}
