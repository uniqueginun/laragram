@extends('layouts.app')

@section('content')
    <div class="container">
        <user-profile :followed-by-me="{{ $followedByMe ? 1 : 0 }}" :user="{{ json_encode($userData) }}" />
    </div>
@endsection