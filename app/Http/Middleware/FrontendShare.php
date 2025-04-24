<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use View;

class FrontendShare
{

  public function handle(Request $request, Closure $next): Response
  {
//    $cart = Cart::mine(false);
//    View::share([
//      'cart'=> $cart
//    ]);
    return $next($request);
  }
}
