@extends('backend.master')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header bg-success text-center" >View Product</div> 
                    <div class="card-body">
                        <div class="card-body">
                            @if(session('delete'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Bad News!</strong> {{ session('delete') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <hr>
                            @endif

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Sub Category</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Images</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $key => $item)
                                    <tr>
                                        <th scope="row">{{ $products->firstItem() + $key }}</th>
                                        <td>{{ $item->product_name ?? N/A }}</td>
                                              <td>{{ $item->get_category->category_name }}</td>
                                                    <td>{{ $item->get_subcategory->subcategory_name }}</td>
                                                    <td>${{ $item->product_price }}</td>
                                                    <td>{{ $item->product_quantity }}</td>
                                                    <td><img src="{{url('img/thumbnail/').'/'. $item->product_thumbnail}}" width="100"></td>
            
   
                                        <td>
                                            <a target="_blank" href="{{url('/item') }}/{{ $item->slug }}" class="btn btn-outline-success">View</a>
                                            <a href="{{url('/edit-product') }}/{{ $item->id }}" class="btn btn-outline-primary">Edit</a>
                                            <a href="{{url('/delete-product') }}/{{ $item->id }}" class="btn btn-outline-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>                                                                           
                            </table>
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection