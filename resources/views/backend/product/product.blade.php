@extends('backend.master')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card">
                    <div class="card-header bg-success text-center" >Add Product's</div> 
                    <div class="card-body">
                        @if(session('success'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Good News!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if(session('update'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Good News!</strong> {{ session('update') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <form action="{{url('add-product-post')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" value="{{ old('product_name') }}" name="product_name" class="form-control .@error('product_name') is-invalid @enderror" id="product_name" placeholder="Enter Product Name">
                                @error('product_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="category_id">Category Name</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="" >Select One</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach 
                                </select>


    <!--<input type="text" value="{{ old('category_name') }}" name="category_name" class="form-control .@error('category_name') is-invalid @enderror" id="name" placeholder="Enter Category Name">-->
                                @error('category_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div> 


                            <div class="form-group">
                                <label for="subcategory_id">Sub Category Name</label>
                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    <option value="" >Select One</option>
                                    @foreach($subcategory as $scat)
                                    <option value="{{$scat->id}}">{{$scat->subcategory_name}}</option>
                                    @endforeach 
                                </select>


    <!--<input type="text" value="{{ old('category_name') }}" name="category_name" class="form-control .@error('category_name') is-invalid @enderror" id="name" placeholder="Enter Category Name">-->
                                @error('category_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div> 

                            <div class="form-group">
                                <label for="product_summary">Product Summary</label>
                           
                                    <textarea name="product_summary" id="product_summary" class="form-control" ></textarea>
                     
                            </div>

                            <div class="form-group">
                                <label for="product_description">Product Description</label>
                                   <textarea name="product_description" id="product_description" class="form-control" ></textarea> 
                            </div>

                            <div class="form-group">
                                <label for="product_price">Product Price</label>
                                <input type="text" name="product_price" class="form-control" id="product_price" placeholder="Enter Product Price">
    
                            </div>

                            <div class="form-group">
                                <label for="product_quantity">Product Quantity</label>
                                <input type="text" name="product_quantity" class="form-control" id="product_quantity" placeholder="Ex:10">
                
                            </div>

                            <div class="form-group">
                                <label for="product_thumbnail">Product Thumbnail</label>
                                <input type="file" name="product_thumbnail" class="form-control" id="product_thumbnail" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                               
                            </div>                           

                            <div class="form-group">
                                <label for="product_preview">Product Preview</label>
                                <img id="blah" alt=" " width="100" height="100" />
                            </div>   

                          <div class="form-group">
                                <label for="product_gallery">Product Gallery</label>
                                <input type="file" name="product_gallery[]" multiple="" class="form-control" id="product_thumbnail" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                               
                            </div>   
                            
                            
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>>
</div>
@endsection