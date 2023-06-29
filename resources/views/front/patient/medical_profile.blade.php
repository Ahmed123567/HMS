@extends("layouts.front_master")


@section("content")
<div class="container">
    <div class="card">

        <div class="card-body pb-3">
            <div class="row text-center">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <img  style="border-radius: 10px;" width="120"
                                src="{{ asset( auth()->user()->imageUrl() ?? defaultImage()) }}" alt="">
                        </div>
                        <div class="col-6 text-left">
                            <input class="form-control "  style="background: #ffffff" disabled type="text" value="Name : {{auth()->user()->patient?->name}}">
                            <input class="form-control mt-2" style="background: #ffffff" disabled type="text" value="Age : {{now()->diffInYears(auth()->user()->patient?->date_of_birth)}}">
                            <input class="form-control mt-2" style="background: #ffffff" disabled type="text" value="Gender : {{ auth()->user()->patient?->gender() }}">
                        </div>
                    </div>
                </div>  
                
                <div class="col-6">
                    <button class="modal_btn btn btn-primary mt-4" data-title="Medical History" data-url="{{ route("patient.view.medical_history") }}">Medical History</button>
                </div>

            </div>

        </div>

    </div>

    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Medical Records</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table text-md-nowrap" id="exampl">
                            <thead>
                                <tr>
                                    <th>Diagnosis</th>
                                    <th>Description</th>
                                    <th>Files</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach (auth()->user()->patient?->records as $record)
                                    <tr>
                                        <td>{{ $record->diagnosis }}</td>
                                        <td>{{ $record->description }}</td>
                                        <td>
                                            @if ($record->files)
                                                <a href="{{ route('patient.files', $record->id) }}">Download Files</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

</div>

@endsection