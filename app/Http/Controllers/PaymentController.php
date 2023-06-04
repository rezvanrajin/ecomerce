<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Shippings;
use App\Models\Sale;
use App\Models\Billings;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Stripe;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    function Payment(Request $request)
    {
      $sub_total = $request->session()->get('sub_total');
      $discount = $request->session()->get('discount');
        $shipping_id = Shippings::insertGetId([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'division_id' => $request->division_id,
            'district_id'=> $request-> district_id,
            'note' => $request->note,
            'created_at' => Carbon::now()
        ]);
        
       $sale_id = Sale::insertGetId([
           
            'user_id' => Auth::user()->id,
            'shipping_id' => $shipping_id,
            'grand_total' => $sub_total,
            'discount' => $discount,
            'created_at' => Carbon::now()
        ]);
       $user_ip = $_SERVER['REMOTE_ADDR'];
        $carts = Cart::with('product')->where('user_ip',$user_ip)->get();
        foreach ($carts as $item)
            {
          Billings::insert([
           
           'user_id' => Auth::user()->id,
           'sale_id' => $sale_id,
           'product_id' => $item->product_id,
           'shipping_id' => $shipping_id,
           'product_price' => $item->product->product_price,
           'product_quantity' => $item->product_quantity,
           'created_at' => Carbon::now()
           ]);
         
           Product::findOrFail($item->product_id)->decrement('product_quantity', $item->product_quantity);
           $item->delete();
          }

          // Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
\Stripe\Stripe::setApiKey('sk_test_51LdaLbFV9tP5vJjyA5Ytn3WZOEisEZViS73bFQe5kPahVqjRjyJeSypUy2aPCV2J9A3UZaNACi0PahmqbAQRY0yx00lqdD7ddp');

$token = $_POST['stripeToken'];
$charge = \Stripe\Charge::create([
  'amount' =>  $sub_total *100,
  'currency' => 'usd',
  'source' => $token,
]);
   $orderdata = Billings::where('shipping_id',$shipping_id)->get();
    
       Mail::to(Auth::user()->email)->send(new OrderShipped($orderdata));    
    return redirect('/shop');
    }
}
