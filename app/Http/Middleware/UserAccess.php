<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
 
class UserAccess
{

    public function handle(Request $request, Closure $next, $userType)
    {
        if(auth()->user()->type == $userType){
            return $next($request);
        }
            
        return response()->json(['Kamu tidak berhasil mengakses page']);
    }
}