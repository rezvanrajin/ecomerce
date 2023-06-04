<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Cart;
use App\Models\Coupon;
use Carbon\Carbon;

class CartController extends Controller
{
        
    function Cart($coupon = '')
    {  if($coupon == '')
            {
        $discount = 0;
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $carts = Cart::with('product')->where('user_ip',$user_ip)->get();
        session(['discount'=> $discount]);
        return view('frontend.cart', compact('carts','discount')); 
        }
        else
            { 
            if(Coupon::where('coupon_code',$coupon)->exists()){
                $validity = Coupon::where('coupon_code',$coupon)->first()->coupon_validity;
                if(Carbon::now()->format('Y-m-d')<= $validity ){
                 $user_ip = $_SERVER['REMOTE_ADDR'];
                 $carts = Cart::with('product')->where('user_ip',$user_ip)->get();
                 $discount = Coupon::where('coupon_code',$coupon)->first()->coupon_discount;   
                 session(['discount'=> $discount]);
                 return view('frontend.cart', compact('carts','discount')); 
                         
                }
                else
                    {
                    return view('frontend.cart', compact('carts','discount'));
                    }
                }
            }
    }
    
    function SingleCartDelete($cart_id)
    {
         $user_ip = $_SERVER['REMOTE_ADDR'];
         Cart::where('id', $cart_id)->where('user_ip',$user_ip)->delete();
        return back()->with('CartDelete','Cart item delete suscessfuly');
    }
    
    
    function CartUpdate(Request $request)
    {
        foreach ($request->cart_id as $key => $item)
            {
            Cart::findOrFail($item)->update([
                'product_quantity' => $request->product_quantity[$key],
                'updated_at' => Carbon::now()
            ]);
            
            }
          return back()->with('CartUpdate','Cart item update suscessfuly');
    }
}
