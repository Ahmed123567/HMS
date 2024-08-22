<div>

    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between">
                <h4 class="card-title mg-b-0">Resrvations</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-10"></div>
                <div class="col-2">
                    <input style="height: 35px !important;" wire:model="query" type="text" class="form-control search_input mb-3"
                        placeholder="search...">
                </div>
            </div>
            <div class="table-responsive" id="reservations">

                <table class="table text-md-nowrap">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Day</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $resrvation)
                            <tr>
                                <td>{{ $resrvation?->patient?->name }}</td>
                                <td>{{ $resrvation?->time?->format('l') }}</td>
                                <td>{{ $resrvation?->time?->format('Y-m-d') }}</td>
                                <td>{{ $resrvation?->time?->format('H:i') }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('patient.medicalProfile', $resrvation?->patient?->id) }}"
                                        class="badge btn btn-info mx-2" data-toggle="tooltip" title="patient profile">
                                        <i class="mdi mdi-eye"></i>
                                    </a>

                                    @if ($resrvation->time->isToday())
                                        @if (!$resrvation?->isClosed() && $resrvation?->isConfirmed())
                                            <button data-title="Appointmet Report"
                                                data-url="{{ route('appointment.reserve.report', $resrvation->id) }}"
                                                class=" modal_btn badge btn btn-primary mx-1" data-toggle="tooltip"
                                                title="close">
                                                <i class="mdi mdi-close"></i>
                                            </button>
                                        @endif

                                        @if (!$resrvation?->isConfirmed())
                                            <form action="{{ route('appointment.reserve.confirm', $resrvation->id) }}"
                                                method="post" class="mx-1">
                                                @csrf
                                                <button data-button_name="Approve"
                                                    class="delete_button badge btn btn-primary" data-toggle="tooltip"
                                                    title="Confirm" type="submit">
                                                    <i data-button_name="Approve" class="mdi mdi-pen"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @endif

                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td  style="text-align: center; pt-3" colspan="5">
                                    No data to show
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

                {!! $reservations->links() !!}
            </div>
        </div>
    </div>

</div>
