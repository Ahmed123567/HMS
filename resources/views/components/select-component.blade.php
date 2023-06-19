<select class="form-control" name="{{$name}}" id="{{$name . "_select"}}">
    {{$slot}}
    @foreach ($models as $key => $toShow)
        @if($key == $value)
            <option selected value="{{$key}}">{{$toShow}}</option>
        @else
            <option value="{{$key}}">{{$toShow}}</option>
        @endif
    @endforeach
</select>

