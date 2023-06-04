@extends('backend.master')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card ">
                    <div class="card-header bg-success text-center" >Deleted Category Total({{$scount}})</div> 
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
                                    @forelse($subcategories as $key => $subcategory)
                                    <tr>
                                        <th scope="row">{{ $subcategories->firstItem() + $key }}</th>
                                        <td>{{ $subcategory->subcategory_name }}</td>
                                        <td>{{ $subcategory->category_id }}</td>
                                        <td>{{ $subcategory->created_at . '(' . $subcategory->created_at->diffForHumans().')' }}</td>

                                        <td>
                                            <a href="{{url('/restore-subcategory') }}/{{ $subcategory->id }}" class="btn btn-outline-success">Restore</a>
                                            <a href="{{url('/permanent-deleted-subcategory') }}/{{ $subcategory->id }}" class="btn btn-outline-danger">Permanent Delete</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center text-primary">
                                        <td colspan="58"><strong>No Data Available</strong></td>
                                    </tr>
                                    @endforelse
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