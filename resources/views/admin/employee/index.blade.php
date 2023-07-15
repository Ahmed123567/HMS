@extends('layouts.master')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Management</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Employees </span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" data-url="{{ route('employee.create') }}" data-title="Create Employee"
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
                        <h4 class="card-title mg-b-0">Employees</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Job Title</th>
                                    <th>Date Of Birth</th>
                                    <th>National Id</th>
                                    <th>Shift</th>
                                    <th>deparmtent</th>
                                    <th>Has Account</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->gender ?? '-' }}</td>
                                        <td>{{ $employee->job_title ?? '-' }}</td>
                                        <td>{{ $employee->date_of_birth ?? '-' }}</td>
                                        <td>{{$employee->national_id ?? '-'}}</td>
                                        <td>{{$employee->shift?->name ?? '-'}}</td>
                                        <td>{{$employee->department?->name ?? '-'}}</td>
                                        <td>{{ $employee->user ? "Yes" : "No" }}</td>
                                        <td class="d-flex">
                                            <button type="button" data-url="{{ route('employee.edit', $employee->id) }}"
                                                data-toggle="tooltip" title="Edit employee" data-title="Edit employee"
                                                class="modal_btn badge btn btn-primary ">
                                                <i class="mdi mdi-pen"></i>
                                            </button>
                                            <form action="{{ route("employee.destroy", $employee->id) }}" method="post" class="mx-1">
                                                @method('delete')
                                                @csrf
                                                <button class="delete_button badge btn btn-danger" data-toggle="tooltip"
                                                    title="Delete Employee" type="submit">
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
