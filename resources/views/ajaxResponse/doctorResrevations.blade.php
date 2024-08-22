<table class="table text-md-nowrap" >
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
        @foreach ($reservations as $resrvation)
            <tr>
                <td>{{ $resrvation?->patient?->name }}</td>
                <td>{{ $resrvation?->time?->format('l') }}</td>
                <td>{{ $resrvation?->time?->format('Y-m-d') }}</td>
                <td>{{ $resrvation?->time?->format('H:i') }}</td>
                <td class="d-flex">
                    <a href="{{ route('patient.medicalProfile', $resrvation?->patient?->id) }}"
                        class="badge btn btn-info mx-2" data-toggle="tooltip"
                        title="patient profile">
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
                            <form
                                action="{{ route('appointment.reserve.confirm', $resrvation->id) }}"
                                method="post" class="mx-1">
                                @csrf
                                <button data-button_name="Approve"
                                    class="delete_button badge btn btn-primary"
                                    data-toggle="tooltip" title="Confirm" type="submit">
                                    <i data-button_name="Approve" class="mdi mdi-pen"></i>
                                </button>
                            </form>
                        @endif
                    @endif

                </td>
            </tr>
        @endforeach

    </tbody>
</table>

{!! $reservations->appends(["appointmentResrvationSearch" => request()->get("appointmentResrvationSearch")])->links() !!}