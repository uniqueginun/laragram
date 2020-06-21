@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <time-line-index />
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <suggestions-index />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection