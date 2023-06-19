


<span @class([
    'badge',
    'bg-success' => $status == 0,
    "bg-danger" => $status == 1,
    "bg-warning" => $status == 2
])>{{$value}}</span>

