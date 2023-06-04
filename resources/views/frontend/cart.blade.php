@extends('frontend.master')
@section('title')
Cart
@endsection()
@section('content')<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Shopping Cart</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Shopping Cart</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- cart-area start -->
<div class="cart-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if(session('CartDelete'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Hey!</strong> {{session('CartDelete')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
               
                                                @if(session('discount'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Hey!</strong> {{session('discount')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                
                @if(session('CartUpdate'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Hey!</strong> {{session('CartUpdate')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <form action="{{Route('CartUpdate')}}" method="post">
                    @csrf
                    <table class="table-responsive cart-wrap">
                        <thead>
                            <tr>
                                <th class="images">Image</th>
                                <th class="product">Product</th>
                                <th class="ptice">Price</th>
                                <th class="quantity">Quantity</th>
                                <th class="total">Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $total = 0;
                            @endphp
                            @forelse($carts  as $cart)

                        <input type="hidden" value="{{$cart->id}}" name="cart_id[]" >
                        <tr>
                            <td class="images"><img src="{{url('img/thumbnail'.'/'.$cart->product->product_thumbnail)}}" alt=""></td>
                            <td class="product"><a href="#">{{$cart->product->product_name}}</a></td>
                            <td class="ptice">${{$cart->product->product_price}}</td>
                            <td class="quantity cart-plus-minus">
                                <input type="text"  name="product_quantity[]"  value="{{$cart->product_quantity}}"/>
                            </td>
                            @php 
                            $total += $cart->product->product_price * $cart->product_quantity 
                            @endphp
                            <td class="total">${{$cart->product->product_price * $cart->product_quantity}}</td>
                            <td class="remove" data-id="{{$cart->id}}"><a href="#"><i class="fa fa-times"></i></a></td>
                        </tr>
                        @empty
                        <tr>
                            <td>You Haven't Choose Any Thing</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="row mt-60">
                        <div class="col-xl-4 col-lg-5 col-md-6 ">
                            <div class="cartcupon-wrap">
                                <ul class="d-flex">
                                    <li>
                                        <button>Update Cart</button>
                                    </li>
                                    <li><a href="{{ route('shop')}}">Continue Shopping</a></li>
                                </ul>
                                <h3>Coupon</h3>
                                <p>Enter Your Coupon Code if You Have One</p>
                                <div class="cupon-wrap">
                                    <input class="CouponValue" type="text" placeholder="Coupon Code">
                                    <span class="couponbtn">Apply Coupon</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                            <div class="cart-total text-right">
                                <h3>Cart Totals</h3>
                                <ul>
                                    <li><span class="pull-left">Subtotal </span>${{$total}}</li>
                                    <li><span class="pull-left">Discount(%) </span>{{$discount}}</li>
                                    <li><span class="pull-left"> Total </span> $685</li>
                                </ul>
                                <a href="{{ route('checkout')}}">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- cart-area end -->
@endsection

@section('footer_js')

<script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function(){
    $(".remove").click(function(){
    var dataId= $(this).attr("data-id");
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    buttons: true,
    dangerMode: true,
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    })
    .then((result) => {
    if (result.isConfirmed) {
    window.location.href ="{{url('single/cart-delete/')}}/"+ dataId;
    swal.fire("Your Cart Item Has Been Deleted!", {
    icon: "success",
    });
    } else {
    swal.fire("Your imaginary file is safe!");
    }

    })
    
})
$('.couponbtn').click(function(){
        var CouponValue = $('.CouponValue').val();
        window.location.href ="{{url('/cart')}}/"+ CouponValue;
        })

    })




</script>

@endsection
