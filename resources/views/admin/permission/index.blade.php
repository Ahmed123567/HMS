@extends('layouts.master')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Tables</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Data
                    Tables</span>
            </div>
        </div>
       
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
   
    <div class="d-flex my-xl-auto right-content">
        <form class="d-flex"  action="{{route("permission.store")}}" method="post">
            @csrf
            <input type="text" name="name" class="form-control">
            <button class="btn btn-primary">create</button>
        </form>

    </div>
  

    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Permissions TABLE</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                     
                                        <td class="d-flex">
                                            
                                            <form action="{{ route("permission.destroy", $permission->id) }}" method="post" class="mx-1">
                                                @method('delete')
                                                @csrf
                                                <button class=" badge btn btn-danger" data-toggle="tooltip"
                                                    title="Delete Permission" type="submit">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    @endsection
    @section('js')
    @endsection
