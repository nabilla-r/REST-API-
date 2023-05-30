<?php

namespace App\Http\Middleware;

use App\Models\Drink;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ShopOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) : Response
    {
        $currentUser = Auth::user();
        $drinks = Drink::findOrFail($request->id);
         if($drinks->author != $currentUser->id)
         {
            return response()->json(['message' => 'data not found'], 404);
         }
         
        return $next($request);
    }
}
