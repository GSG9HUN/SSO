@extends('view_blades.layouts.basic_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <a href="{{route("sso.login")}}" class="btn btn-block btn-danger btn-sm">Login with custom SSO</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
