<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;

class JWTBearer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $key = env('JWT_KEY');
        try {
            JWT::decode($request->bearerToken(), $key, array('HS256'));
            return $response;
        } catch (\Exception $e) {
            if ($e instanceof SignatureInvalidException){
                return response()->json(['status' => 'ERROR',
                    'code' => '400',
                    'message' => 'Invalid Signature',
                ], 400);
            } else if ($e instanceof ExpiredException) {
                return response()->json(['status' => 'ERROR',
                    'code' => '401',
                    'message' => 'JWT Expired',
                ], 401);
            } else if ( $e instanceof BeforeValidException) {
                return response()->json(['status' => 'ERROR',
                    'code' => '402',
                    'message' => 'JWT Before Validation',
                ], 402);
            } else {
                return response()->json(['status' => 'ERROR',
                    'code' => '403',
                    'message' => 'Error Exception JWT',
                ], 403);
            }
        }
    }
}
