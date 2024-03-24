@extends('view_blades.layouts.basic_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Email megerősítés szükséges') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Egy megerősítő emailt küldtünk az email címedre.') }}
                        </div>
                    @endif

                    {{ __('Kérlek erősítsd meg az email címedet, ahhoz, hogy a regisztrációt véglegesítsd.') }}
                    {{ __('Ha nem kaptál megerősítő emailt') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Kérlek klikkelj ide, hogy újabb emailt-küldjünk.') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
