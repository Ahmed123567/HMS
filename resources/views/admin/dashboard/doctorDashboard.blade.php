<div class="row mt-5">
    <div class="col-lg-4 col-md-6">
        <div class="card  bg-primary-gradient">
            <div class="card-body">
                <div class="counter-status d-flex md-mb-0">
                    <div class="counter-icon">
                        <a href="{{ route('appointment.reserve.resrvations', $employee?->id) }}"><i
                                class="icon icon-people"></i></a>
                    </div>
                    <div class="mr-auto">
                        <a href="{{ route('appointment.reserve.resrvations', $employee?->id) }}">
                            <h5 class="tx-13 tx-white-8 mb-3">Resrvations</h5>
                        </a>
                        <h2 class="counter mb-0 text-white">
                            {{ auth()->user()->employee?->reservatoins()?->count() ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card  bg-danger-gradient">
            <div class="card-body">
                <div class="counter-status d-flex md-mb-0">
                    <div class="counter-icon text-warning">
                        <a href="{{ route('appointment.reserve.resrvations', [$employee?->id, 'today' => '1']) }}"><i
                                class="icon icon-rocket"></i></a>
                    </div>
                    <div class="mr-auto">
                        <a href="{{ route('appointment.reserve.resrvations', [$employee?->id, 'today' => '1']) }}">
                            <h5 class="tx-13 tx-white-8 mb-3">Today Resrvations</h5>
                        </a>
                        <h2 class="counter mb-0 text-white">
                            {{ $employee?->reservatoins()->today()->count() ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card  bg-success-gradient">
            <div class="card-body">
                <div class="counter-status d-flex md-mb-0">
                    <div class="counter-icon text-primary">
                        <i class="icon icon-docs"></i>
                    </div>
                    <div class="mr-auto">
                        <h5 class="tx-13 tx-white-8 mb-3">My Patients</h5>
                        <h2 class="counter mb-0 text-white">
                            {{ $employee?->reservatoins()->distinct()->count('patient_id') ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row row-sm">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Today Reservations</h4>
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
                                <th>Patient</th>
                                <th>Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employee?->reservatoins()->today()?->latest()->take(5)->get() as $resrvation)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $resrvation?->patient?->name }}</td>
                                    <td>{{ $resrvation?->time?->format('H:i') }}</td>
                                    <td class="d-flex">

                                        <a class="badge btn btn-info mx-2" data-toggle="tooltip"
                                            title="patient profile">
                                            <i class="mdi mdi-eye"></i>
                                        </a>

                                        @if (!$resrvation?->isClosed() && $resrvation?->isConfirmed())
                                            <button data-title="Appointmet Report" data-url="{{route("appointment.reserve.report", $resrvation->id)}}" class=" modal_btn badge btn btn-primary mx-2" data-toggle="tooltip" title="close">
                                                <i class="mdi mdi-close"></i>
                                            </button>
                                        @endif

                                        @if (!$resrvation?->isConfirmed())
                                            <form action="{{ route('appointment.reserve.confirm', $resrvation->id) }}"
                                                method="post" class="mx-2">
                                                @csrf
                                                <button data-button_name="Approve"
                                                    class="delete_button badge btn btn-primary" data-toggle="tooltip"
                                                    title="Confirm" type="submit">
                                                    <i data-button_name="Approve" class="mdi mdi-pen"></i>
                                                </button>
                                            </form>
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
    <!--/div-->

    <!--div-->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">My Patients</h4>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employee?->patients()->take(5) as $patient)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$patient->name}}</td>
                                    <td>{{$patient?->resrvations()->forAuthDoctor()->closed()->count()}}</td>
                                </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /row -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
