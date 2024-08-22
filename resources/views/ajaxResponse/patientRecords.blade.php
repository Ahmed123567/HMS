<table class="table text-md-nowrap" id="exampl">
    <thead>
        <tr>
            <th>Diagnosis</th>
            <th>Description</th>
            <th>Doctor</th>
            <th>Department</th>
            <th>Files</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($records as $record)
            <tr>
                <td>{{ $record->diagnosis }}</td>
                <td>{{ $record->description }}</td>
                <td>{{ $record->resrvation->doctor->name ?? '-' }}</td>
                <td>{{ $record->resrvation->doctor->department->name ?? "-" }}</td>
                <td>
                    @if ($record->files)
                        <a href="{{ route('patient.files', $record->id) }}">Download Files</a>
                    @endif
                </td>
            </tr>
        @endforeach

    </tbody>
</table>



{!! $records->appends(["patientRecordSearch" => request("patientRecordSearch")])->links('pagination::bootstrap-4') !!}