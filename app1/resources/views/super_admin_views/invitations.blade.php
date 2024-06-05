@extends('super_admin_views.layout.super_admin_layout')

@section('content')
    <div id="{{\Request::route()->getName()}}">
        <script>
            // Az access token értékét PHP kóddal állítsd be egy JavaScript változóba
            let accessToken = "{{ $accessToken }}";
            let refreshToken = "{{ $refreshToken }}";

            // Mentsd el az access tokent a local storage-be
            localStorage.setItem('accessToken', accessToken);
            localStorage.setItem('refreshToken', refreshToken);
        </script>
    </div>
@endsection
