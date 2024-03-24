<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <link rel="stylesheet" href="window.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
          integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/adminCustom.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>

<body>

<div class="wrapper">

    <div class="sidebar">
        @include('admin_views.layout.sidebar.sidebar')
    </div>

    <div class="main-panel">
        <div class="content2">
            <h2>Responsive Sidebar Example</h2>
            <p>This example use media queries to transform the sidebar to a top navigation bar when the screen size is 700px
                or
                less.</p>
            <p>We have also added a media query for screens that are 400px or less, which will vertically stack and center
                the
                navigation links.</p>
            <p>We have also added a media query for screens that are 400px or less, which will vertically stack and center
                the
                navigation links.</p>
            <p>We have also added a media query for screens that are 400px or less, which will vertically stack and center
                the
                navigation links.</p>
            <p>We have also added a media query for screens that are 400px or less, which will vertically stack and center
                the
                navigation links.</p>
            <p>We have also added a media query for screens that are 400px or less, which will vertically stack and center
                the
                navigation links.</p>
            <h3>Resize the browser window to see the effect.</h3>
        </div>
    </div>

    <div class="footer">
        @include('admin_views.layout.footer.footer')
    </div>
</div>


<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>


</html>
