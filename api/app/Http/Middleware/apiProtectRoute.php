<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class apiProtectRoute extends BaseMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next)
  {
    try {
      $user = JWTAuth::parseToken()->authenticate();
    } catch (Exception $e){
      if ($e instanceof TokenInvalidException){
        return response()->json(['statusText' => 'Token is Invalid'], 404);
      } else if ($e instanceof TokenExpiredException){
        return response()->json(['statusText' => 'Token is Expired'], 401);
      } else {
        return response()->json(['status' => 'Authorization Token not found']);
      }
    }
    return $next($request);
  }
}
