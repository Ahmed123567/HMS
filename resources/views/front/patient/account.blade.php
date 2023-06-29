@extends('layouts.front_master')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route("patient.view.accountUpdate") }}" method="post" enctype="multipart/form-data">
      @method("put")
      @csrf
        <div class="container mt-5 ">
            <div class="main-body ">
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="{{ asset(auth()->user()->imageUrl()) }}" id="profile_image" alt="Admin"
                                        class="rounded-circle" width="150">
                                    <input type="file" style="display: none" name="image" id="image_input">
                                    <div class="mt-3">
                                        <h4>{{ auth()->user()->name }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <h6 class="mt-3">Name</h6>
                                    </div>
                                    <div class="col-sm-9  text-secondary ">
                                        <input type="text" name="name" class="form-control "
                                            value="{{ auth()->user()->name }}">
                                          
                                        </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <h6 class="mt-3">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="email" name="email" class="form-control"
                                            value="{{ auth()->user()->email }}" id="">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <h6 class="mt-3">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="phone_number" class="form-control"
                                            value="{{ auth()->user()->phone_number }}" id="">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <h6 class="mb-0">Role</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ auth()->user()->role?->name }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <h6 class="mb-0">Patient Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ auth()->user()->patient?->name }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button class="btn btn-info">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection

@push('js')
    <script>
        const imageInput = document.getElementById("image_input");
        const imgaeTag = document.getElementById("profile_image");

        imgaeTag.onclick = event => imageInput.click();

        imageInput.onchange = event => {
            const [file] = imageInput.files
            if (file) {
                imgaeTag.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush
