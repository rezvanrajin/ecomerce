<?php

namespace App\Http\Controllers;
use App\Models\Division;
use App\Models\District;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Controllers\seesion;

class CheckoutController extends Controller
{
    function __construct() {
        $this->middleware('auth');
    }
    
                
    function Checkout()
    {
        $auth_user = Auth::user();
        $divisions = Division::orderBy('name','asc')->get();
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $carts = Cart::with('product')->where('user_ip',$user_ip)->get();
        $sub_total = 0;
      foreach ($carts as $cart)
            {
            $sub_total += $cart->product_price * $cart->product_quantity;
                }
            session(['sub_total'=> $sub_total]);
        return view('frontend.checkout', compact('auth_user','divisions','sub_total','carts'));
    }
    function GetdistrictList($division_id)
    {
        $district = District::where('division_id',$division_id)->get();
        return response()->json($district);
    }
    
}
