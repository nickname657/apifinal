<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class verifiemployee extends Middleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {


    
    $user = DB::table('users')
      ->where('id', $request->iduser)
      ->pluck(
        'type'
      );
    if ($user == 'empleado') {
      return $next($request);
    }
    return $next($request);
    
  }
}
