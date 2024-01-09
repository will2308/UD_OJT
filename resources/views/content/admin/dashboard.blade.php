@extends('admin')
@section('content')

@foreach ($data as $item)
    @if ($item['verify'] == 'y')     
    <div class="card border-primary mb-3 m-3" style="max-width: 20rem;">
        <div class="card-header">{{$item['name']}}</div>
        <div class="card-body">
            <h4 class="card-title">{{$item['count']}}</h4>
        </div>
    </div>
    @endif
@endforeach

@endsection