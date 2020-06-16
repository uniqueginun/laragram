@extends('layouts.app')

@section('content')
    <div class="container">
        <user-profile :user="{{ json_encode($userData) }}" />
    </div>
@endsection