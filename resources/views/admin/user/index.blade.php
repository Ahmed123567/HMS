@extends('layouts.master')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Management</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Users</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" data-url="{{ route('user.create') }}" data-title="Create User"
                    class="modal_btn btn btn-info btn-icon ml-2"><i class="mdi mdi-plus"></i></button>
            </div>

        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Users</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1" style="vertical-align: middle;">
                            <thead>
                                <tr>
                                    <th style="width:5%">Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Role</th>
                                    <th>Employee</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="vertical-align: middle;">

                                @foreach ($users as $user)
                                    <tr>
                                        <td><img  style="width: 100%;"
                                                src="{{ asset('storage/images/' . $user->image ?? "default.jpg" ) }}" class="rounded-circle"></td>
                                        <td >{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone_number ?? '-' }}</td>
                                        <td>{{ $user->role?->name ?? '-' }}</td>

                                        <td>{{$user->person()}}</td>

                                        <td class="d-flex">
                                            <button type="button" data-url="{{ route('user.edit', $user->id) }}"
                                                data-toggle="tooltip" title="Edit User" data-title="Edit User"
                                                class="modal_btn badge btn btn-primary ">
                                                <i class="mdi mdi-pen"></i>
                                            </button>
                                            <form action="{{ route("user.destroy", $user->id) }}" method="post" class="mx-1">
                                                @method('delete')
                                                @csrf
                                                <button class=" delete_button badge btn btn-danger" data-toggle="tooltip"
                                                    title="Delete User" type="submit">
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
