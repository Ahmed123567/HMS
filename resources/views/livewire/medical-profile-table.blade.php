<div>

    <div class="card shadow">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between">
                <h4 class="card-title mg-b-0">Medical Records</h4>
                <i class="mdi mdi-dots-horizontal text-gray"></i>
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

            <div class="table-responsive" id="recordsTable">
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
                                <td>{{ $record->resrvation->doctor->department->name ?? '-' }}</td>
                                <td>
                                    @if ($record->files)
                                        <a href="{{ route('patient.files', $record->id) }}">Download Files</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                {!! $records->links() !!}

            </div>
        </div>
    </div>

</div>
