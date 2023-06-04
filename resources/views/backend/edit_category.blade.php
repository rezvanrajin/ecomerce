@extends('backend.master')

@section('content')

<div class="content">
        <div class="container-fluid">
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card bg-light mb-3" style="margin-top: 10%;">
                <div class="card-header bg-success text-center" >Edit Category</div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Good News!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <form action="{{url('/update-category-post')}}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $category->id }}" name="category_id">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" value="{{ $category->category_name }}" name="category_name" class="form-control .@error('category_name') is-invalid @enderror" id="name" placeholder="Enter Category Name">
                            @error('category_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
      </div>>
@endsection