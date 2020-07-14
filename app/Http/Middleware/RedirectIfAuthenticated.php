<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $roles = Auth::user()->Role->role_title;
            switch ($roles) {
                case 'Admin':
                    return redirect('/admin/users');
                    break;
                case 'Kepala Sekolah':
                    return redirect('/kepala-sekolah/mengelola-kegiatan');
                    break;
                case 'Penanggung Jawab Kegiatan':
                    return redirect('/penanggung-jawab/mengelola-kegiatan');
                    break;
                default:
                    return redirect('/');
                    break;
            }
            // return redirect('/home');
        }
        return $next($request);
    }
}
