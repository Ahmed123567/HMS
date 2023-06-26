


<option value="">choose doctor</option>

@foreach ($doctors as $doctor)
    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
@endforeach