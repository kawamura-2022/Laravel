@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>You are logged in!<p>
                    <p>
                        (5秒後に自動でページが切り替わります)
                        <div class="links">
                            <a href="{{url('/')}}">切り替わらない場合はこちら</a>
                        </div>
                    </p>
                    <META http-equiv="Refresh" content="5;URL={{ url('/') }}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
