<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\VisitorCount;
use Carbon\Carbon;

class FrontendController extends Controller
{
    function FrontPage()
    {   $product = Product::all();
       return view('frontend.main', compact('product')); 
    }
    
    function SingleProduct($slug)
     {
        $product = Product::where('slug',$slug)->first();
        $title = $product->product_name;
         $related_product = Product::where('category_id',$product->category_id)->limit(4)->inRandomOrder()->get(); 
         
         $user_ip = $_SERVER['REMOTE_ADDR'];
         
         $visitor_check = VisitorCount::where('product_id',$product->id)->where('user_ip',$user_ip)->first();
         
         if($visitor_check)
             {
             VisitorCount::increment('visited');
             }
             
 else 
     {
                 VisitorCount::insert([
                     'product_id' => $product->id,
                     'user_ip' => $user_ip,
                     'visited' => 1
                 ]);
     }
         
         return view('frontend.single_product', compact('product', 'title','related_product')); 
    }
    function  Shop()
    {
        $categories = Category::orderBy('category_name','asc')->get();
        $products = product::orderBy('product_name','asc')->get();
        return view('frontend.shop', compact('categories','products'));
        
    }
    
    function SingleCart($product_id)
    {
        $user_ip = $_SERVER['REMOTE_ADDR'];
        
        if(Cart::where('product_id',$product_id)->where('user_ip',$user_ip)->exists()){
            
            Cart::where('product_id',$product_id)->where('user_ip',$user_ip)->increment('product_quantity');
        }
 else {
     Cart::insert
             ([
                 'product_id' => $product_id,
                 'user_ip' => $user_ip,
                 'created_at' => Carbon::now(),
             ]);   
}   
return back();
    
    }

    
}
