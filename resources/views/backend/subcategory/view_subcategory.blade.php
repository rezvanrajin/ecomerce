@extends('backend.master')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card ">
                    <div class="card-header bg-success text-center" >View Sub Category  Total({{$scount}})</div> 
                    <div class="card-body">
                        <div class="card-body">
                            @if(session('delete'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Bad News!</strong> {{ session('delete') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Sub Category Name</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Create_at</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <tbody>
                                    @foreach($subcategories as $key => $subcategory)
                                    <tr>
                                        <th scope="row">{{ $subcategories->firstItem() + $key }}</th>
                                        <td>{{ $subcategory->subcategory_name }}</td>
                                        <td>{{ $subcategory->get_category->category_name }}</td>
                                        <td>{{ $subcategory->created_at . '(' . $subcategory->created_at->diffForHumans().')' }}</td>

                                        <td>
                                            <a href="{{url('/edit-category') }}/{{ $subcategory->id }}" class="btn btn-outline-primary">Edit</a>
                                            <a href="{{url('/delete-subcategory') }}/{{ $subcategory->id }}" class="btn btn-outline-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                             {{ $subcategories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection