<div {{ $attributes->merge(['class' => 'form-group']) }}>
    <label for="">Employee</label>
    <select class="form-control" name="employee_id" id="employee_select">
            <option selected disabled>Select Person</option>
        @foreach ($employees as $id => $name)
            @if ($value && $value == $id)
                <option selected value="{{ $id }}">{{ $name }}</option>
            @else
                <option value="{{ $id }}">{{ $name }}</option>
            @endif
        @endforeach
    </select>
</div>
