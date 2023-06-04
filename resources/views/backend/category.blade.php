@extends('backend.master')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card">
               <div class="card-header bg-success text-center" >Add Category</div> 
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
                            <form action="{{url('/add-category-post')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" value="{{ old('category_name') }}" name="category_name" class="form-control .@error('category_name') is-invalid @enderror" id="name" placeholder="Enter Category Name">
                                @error('category_name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
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