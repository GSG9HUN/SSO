@extends('view_blades.layouts.basic_layout')
@section('content')
<div id="nav" >
    <div class="logo">
        <a id="test" href="{{route('guest.welcome')}}" ><span class="icon fa-gem" ></span></a>
    </div>
    <div class="content">
        <div class="inner">
            <h1>VIRTUÁLIS menhely</h1>
            <p>Az oldal célja hogy minden menhelyen és utcákon élő állat<br />
                meleg otthonra és szerető családra találjon.</p>
        </div>
    </div>
    <nav>
        <ul>
            <li><a href='{{route('guest.animals')}}'>Állatok</a></li>
            <li><a href="{{route('guest.shelters')}}">Menhelyek</a></li>
            <li><a href="{{route('guest.about')}}">Rólunk</a></li>
            <li><a href="{{route('login')}}">Belépés</a></li>
            <li><a href="#elements">Támogatóink</a></li>
        </ul>
    </nav>
</div>
@endsection
