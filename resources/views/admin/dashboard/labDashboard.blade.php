
@<?php
use App\Models\Employee ;
use App\Models\Department;
use App\Models\Lab;


$lab = Lab::all();
$lab2 = Lab::all();


?>
extends('layouts.master')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">


        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
<div class="my--container">
<div class="col-xl-12">
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between">
                <h4 class="card-title mg-b-0">Pending <div class="spinner-border spinner-border-sm text-info" role="status"> <span class="sr-only">Loading...</span> </div></h4>
                <button class="btn btn-info btn-with-icon" data-target="#modaldemo3" data-toggle="modal"><i class="typcn typcn-plus"></i> Create New</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="lab-pending" class="table mg-b-0 text-md-nowrap">
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
                    @foreach($lab as $lab)
                    @if($lab->status == 'pending')
                    <tbody>
                        <tr>
                            <th scope="row">{{$lab->id}}</th>
                            <td>{{$lab->patient_id}}</td>
                            <td>{{$lab->type}}</td>
                            <td>{{$lab->doctor_name}}</td>
                            <td>{{$lab->department_name}}</td>
                            <td>
                                <button class="btn btn-info btn-with-icon" data-toggle="modal" data-target="#modal4{{$lab->patient_id}}">
                                <i class="fe fe-paperclip" style="font-size: 15px;"></i>
                                   Attatch
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <div class="modal" id="modal4{{$lab->patient_id}}" aria-labelledby="modal4{{$lab->patient_id}}Label" value="{{$lab->patient_id}}">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Request Analysis</h6>
                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('/StoreAttachment', $lab->patient_id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-lg">
                                            <p class="mg-b-10">Patient ID</p>
                                            <input class="form-control" placeholder="Enter ID" name="patient_id" id="patient-id" value="{{$lab->patient_id}}" readonly>
                                        </div>
                                        <br>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <input class="form-control" placeholder="Patient name" name="name" id="patient-name" readonly="text">
                                        </div>
                                        <br>
                                        <div class="col-lg">
                                            <p class="mg-b-10">Attachment</p>
                                            <input class="form-control" placeholder="Add attachment" name="attachements" id="attachment" type="file">
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button class="btn ripple btn-info" type="submit">Confirm</button>
                                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-12">
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between">
                <h4 class="card-title mg-b-0">Finished <i class="fa fa-check" style="color:#22c03c"></i></h4>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id = "lab-finished" class="table mg-b-0 text-md-nowrap">
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
                    @if($lab->status == 'finished')
                    <tbody>
                        <tr>
                            <th scope="row">{{$lab->id}}</th>
                            <td>{{$lab->patient_id}}</td>
                            <td>{{$lab->type}}</td>
                            <td>{{$lab->doctor_name}}</td>
                            <td>{{$lab->department_name}}</td>
                            <td><a class="btn btn-info button-with-icon" href="{{ asset('storage/images/'.$lab->attachements) }}" target="_blank">
                            <i class="fe fe-eye"></i>
                            Show Attachement</a>
                                {{-- <img src="{{asset('storage/images/'.$lab->attachements  )}}" width="50px" height="50px" > --}}
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

<div class="modal" id="modaldemo3">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Request Analysis</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{url('/StoreLab')}}"  method="post">
                    @csrf
                <h6>Analysis Details</h6>
                <div class="col-lg">
                <p class="mg-b-10">Patient ID</p>
                    <input class="form-control" placeholder="Enter ID"  name ="patient_id" id="patient_id"  type="text">
				</div>
                <br>
                <div class="col-lg mg-t-10 mg-lg-t-0">
                    <input class="form-control" placeholder="Patient name" name="name"  id="patient_name" readonly="text">
                </div>
                <br>
                <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                    <p class="mg-b-10">Analysis type</p><select class="form-control select2" name="type">
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
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div>
        </form>

        </div>
    </div>

</div>




@endsection

@section('js')
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
@endsection



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Fetch patient name based on ID
        $('#patient_id').on('input', function() {
            var patientId = $(this).val();
            fetchPatientName(patientId);
        });

        function fetchPatientName(patientId) {
            $.ajax({
                url: '/fetch-patient-name/' + patientId, // Updated route URL with the patient ID
                type: 'GET',
                success: function(response) {
                    $('#patient_name').val(response);
                },
                error: function() {
                    $('#patient_name').val('');
                    console.log('Error occurred while fetching patient name.');
                }
            });
        }
    });
</script>

{{-- <script>
$(document).ready(function() {
    $('#modal4').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var labId = button.data('id');
        $('#patient-id').val(labId);
    });
});
</script> --}}


<script>
    setInterval(function() {
        $("#lab-pending").load(window.location.href + " #lab-pending");

        $("#lab-finished").load(window.location.href + " #lab-finished");

    }, 5000);
</script>



