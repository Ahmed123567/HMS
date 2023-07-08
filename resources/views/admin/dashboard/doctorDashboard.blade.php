<?php
use App\Models\Employee ;
use App\Models\Department;
use App\Models\Lab;


$lab2 = Lab::all();
?>


<div class="row mt-5">
    <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <div class="feature widget-2 text-center mt-0 mb-3">
                    <i class="fa fa-address-book  project bg-success-transparent mx-auto text-success "></i>
                </div>
                <h6 class="mb-1 text-muted">Resrvations</h6>
                <h3 class="font-weight-semibold">{{ auth()->user()->employee?->reservatoins()?->count() ?? 0 }}
                </h3>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <div class="feature widget-2 text-center mt-0 mb-3">
                    <i class="fa fa-calendar  project bg-warning-transparent mx-auto text-warning "></i>
                </div>
                <h6 class="mb-1 text-muted">Today's Resrvations</h6>
                <h3 class="font-weight-semibold">{{ $employee?->reservatoins()->today()->count() ?? 0 }}
                </h3>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <div class="feature widget-2 text-center mt-0 mb-3">
                    <i class="fa fa-address-card  project bg-info-transparent mx-auto text-info "></i>
                </div>
                <h6 class="mb-1 text-muted">My Patients</h6>
                <h3 class="font-weight-semibold">{{ $employee?->reservatoins()->distinct()->count('patient_id') ?? 0 }}
                </h3>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
        <div class="card text-center">
            <div class="card-body ">
                <div class="feature widget-2 text-center mt-0 mb-3">
                    <i class="ti-github project bg-info-transparent mx-auto text-info "></i>
                </div>
                <h6 class="mb-1 text-muted">AI DOCTOR</h6>

                <a href="{{ route("autoDoctor.index") }}" target="_blank" class="btn btn-primary btn-rounded btn-sm "><i
                        class="fas fa-external-link-alt"></i> OPEN </a>

            </div>
        </div>
    </div>
</div>


<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0"><div class="spinner-border spinner-border-sm text-info" role="status"> </div>&nbsp Today's Reservations </h4>
                    <div class="messages">
                        <span class="text-info">{{ $employee?->reservatoins()->today()->confirmed()->count() ?? 0 }}
                            confirmed</span>
                        &nbsp;&nbsp;&nbsp;
                        <span class="text-danger">{{ $employee?->reservatoins()->today()->closed()->count() ?? 0 }}
                            closed</span>

                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Patient ID </th>
                                <th>Patient Name </th>
                                <th>doctor id </th>
                                <th>Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employee?->reservatoins()->today()?->latest()->take(5)->get() as $resrvation)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $resrvation?->patient?->id }}</td>
                                <td>{{ $resrvation?->patient?->name }}</td>
                                <td>{{ $name = $employee?->name }}</td>
                                <td>{{ $resrvation?->time?->format('H:i') }}</td>
                                <td class="d-flex">
                                    <a href="{{ route("patient.medicalProfile", $resrvation?->patient->id) }}"
                                        class="btn btn-info btn-icon">
                                        <i class="mdi mdi-eye"></i>
                                    </a>

                                    @if (!$resrvation?->isClosed() && $resrvation?->isConfirmed())
                                    &nbsp
                                    <button class="modal_btn btn btn-sm btn-danger btn-icon"
                                        data-title="Appointmet Report"
                                        data-url="{{route("appointment.reserve.report", $resrvation->id)}}">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                    &nbsp
                                    @endif

                                    @if (!$resrvation?->isConfirmed())
                                    <form action="{{ route('appointment.reserve.confirm', $resrvation->id) }}"
                                        method="post" class="mx-2">
                                        @csrf
                                        <button class="delete_button btn btn-sm btn-info btn-icon"
                                            data-button_name="Approve" type="submit">
                                            <i data-button_name="Approve" class="fa fa-stethoscope"></i>
                                        </button>
                                    </form>
                                    @endif

                                    <button class="btn btn-sm btn-info btn-icon" data-toggle="modal"
                                        data-target="#modal4{{$resrvation?->patient->id}}">
                                        <i class="fa fa-flask"></i>

                                    </button>
                                </td>
                                <div style="display: none;">
                                    {{$employee = Employee::where('name', $name)->first();}}
                                    {{$department_id = $employee->department_id; }}
                                    {{$department = Department::where('id', $department_id)->first();}}
                                    {{$department_name = $department->name; }}
                                </div>
                                <div class="modal" id="modal4{{$resrvation?->patient->id}}"
                                    aria-labelledby="modal4{{$resrvation?->patient->id}}Label"
                                    value="{{$resrvation?->patient->id}}">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Request Analysis</h6>
                                                <button aria-label="Close" class="close" data-dismiss="modal"
                                                    type="button">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('/Storelab2') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="col-lg">
                                                        <p class="mg-b-10">Patient ID</p>
                                                        <input class="form-control" placeholder="Enter ID"
                                                            name="patient_id" id="patient-id"
                                                            value="{{$resrvation?->patient->id}}" readonly>
                                                    </div>
                                                    <br>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <p class="mg-b-10">Patient Name</p>
                                                        <input class="form-control" placeholder="Patient name"
                                                            name="patient_name" id="patient_name"
                                                            value="{{$resrvation?->patient->name}}" readonly="text">
                                                    </div>
                                                    <br>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <p class="mg-b-10"> Doctor Name </p>
                                                        <input class="form-control" placeholder="Patient name"
                                                            name="doctor_name" id="doctor_name"
                                                            value="{{$employee?->name}}" readonly="text">
                                                    </div>

                                                    <br>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <p class="mg-b-10"> Department Name </p>
                                                        <input class="form-control" placeholder="Patient name"
                                                            name="department_name" id="department_name"
                                                            value="{{$department_name}}" readonly="text">
                                                    </div>
                                                    <br>
                                                    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                                        <p class="mg-b-10">Analysis type</p><select
                                                            class="form-control select2" name="type">
                                                            <option label="Analysis">
                                                            </option>
                                                            <option value="COVID">
                                                                COVID
                                                            </option>
                                                            <option value="X-RAY">
                                                                X-RAY
                                                            </option>
                                                        </select>
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn ripple btn-info" type="submit">Confirm</button>
                                                <button class="btn ripple btn-secondary" data-dismiss="modal"
                                                    type="button">Close</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div-->




</div>

<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0"><i class="fa fa-check-circle" style="color:#22c03c"></i>&nbsp Finished</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="lab-finished" class="table mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Patient ID</th>
                                <th>Type</th>
                                <th>doctor</th>
                                <th>Dept</th>
                                <th>Files</th>
                            </tr>
                        </thead>
                        @foreach($lab2 as $lab)
                        @if($lab->status == 'finished' && $lab->doctor_name==$employee->name)
                        <tbody>
                            <tr>
                                <th scope="row">{{$lab->id}}</th>
                                <td>{{$lab->patient_id}}</td>
                                <td>{{$lab->type}}</td>
                                <td>{{$lab->doctor_name}}</td>
                                <td>{{$lab->department_name}}</td>
                                <td><a class="btn btn-info button-with-icon" href="{{ asset('storage/images/'.$lab->attachements) }}"
                                        target="_blank">
                                        <i class="fe fe-eye"></i>
                                        Show Attachement</a>
                                    {{-- <img src="{{asset('storage/images/'.$lab->attachements  )}}" width="50px"
                                    height="50px" > --}}
                                </td>

                            </tr>
                        </tbody>
                        @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--div-->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0"><i class="fa fa-address-book" style="color:#00b4ff"></i>&nbsp My Patients</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Number Of Visits</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employee?->patients()->take(5) as $patient)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$patient->name}}</td>
                                <td>{{$patient?->resrvations()->forAuthDoctor()->closed()->count()}}</td>
                                <td class="d-flex">

                                    <a href="{{ route("patient.medicalProfile", $patient->id) }}"
                                        class="badge btn btn-info mx-2" data-toggle="tooltip" title="patient profile">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
</div>