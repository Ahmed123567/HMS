<div {{ $attributes->merge(['class' => 'form-group']) }}>
    <label for="">Role</label>
    <select class="form-control" name="role_id" id="role_select">
        <option selected  disabled >Select Role</option>
        @foreach ($roles as $id => $name)
            @if ($value && $value == $id)
                <option selected value="{{ $id }}">{{ $name }}</option>
            @else
                <option value="{{ $id }}">{{ $name }}</option>
            @endif
        @endforeach
    </select>

    
</div>

