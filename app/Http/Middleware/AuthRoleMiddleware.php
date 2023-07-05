<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      $user = auth()->user();
      if (!$user) {
        return redirect('login')->with(['error' => 'Sesi kedaluarsa. mohon login ulang!']);
      }
      if ($request->segment(1) !== $user->role) {
        auth()->logout();
        return redirect('/login')->with(['error' => ucfirst($user->role).' tidak bisa mengakses halaman '.$request->segment(1).', silahkan login menggunakan akun '.$user->role]);
      }
      return $next($request);
    }
}
