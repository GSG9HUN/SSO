@extends('view_blades.layouts.basic_layout')

@section('content')
    <div id="{{\Request::route()->getName()}}">
        <article id="about">
            <h2 class="major">Rolunk</h2>
            <span class="image main"><img src="{{asset('../images/pic03.jpg')}}" alt=""/></span>
            <p>Lorem ipsum dolor sit amet, consectetur et adipiscing elit. Praesent eleifend dignissim arcu, at eleifend
                sapien imperdiet ac. Aliquam erat volutpat. Praesent urna nisi, fringila lorem et vehicula lacinia quam.
                Integer sollicitudin mauris nec lorem luctus ultrices. Aliquam libero et malesuada fames ac ante ipsum
                primis in faucibus. Cras viverra ligula sit amet ex mollis mattis lorem ipsum dolor sit amet.</p>
        </article>
    </div>
@endsection
