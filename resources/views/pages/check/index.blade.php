@extends('layouts.app')

@section('title')
    Check
@endsection

@section('content')
<ul>
    <a href="{{ route('check.create') }}" type="button" class="bg-red-500 p-3 text-white">create</a>
    @foreach ($check as $c)
        <li>{{ $c['weight_check']}}, {{ $c['height_check']}}</li>
        <form action="{{route('check.destroy', $p['id'])}}" method="post">
            @method("DELETE")
            @csrf
        </form>
        <button type="button" class="bg-grey-500 p-3 text-white">read</button>
    @endforeach
</ul>
@endsection
