@extends('backend.master')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card ">
                    <div class="card-header bg-success text-center" >View Category</div> 
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
                                        <th scope="col">Name</th>
                                        <th scope="col">Create_at</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category as $key => $cat)
                                    <tr>
                                        <th scope="row">{{ $category->firstItem() + $key }}</th>
                                        <td>{{ $cat->category_name }}</td>
                                        <td>{{ $cat->created_at . '(' . $cat->created_at->diffForHumans().')' }}</td>
                                  <!--      <td>{{ $cat->updated_at}}</td>-->
                                        <td>
                                            <a href="{{url('/edit-category') }}/{{ $cat->id }}" class="btn btn-outline-primary">Edit</a>
                                            <a href="{{url('/delete-category') }}/{{ $cat->id }}" class="btn btn-outline-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>                                                                           
                            </table>
                            {{ $category->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection