<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/css/sidebar/sidebar.css', 'resources/css/admin/main.css', 'resources/js/app.js', 'resources/sass/app.scss'])
    <title>{{ $title }}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    @stack('scripts')
    @stack('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
</head>

<body>
    @include('sweetalert::alert')
    @include('layouts.sidebar')
    <div class="mainContent">
        <div class="topContent flex">
            <div class="headerContent flex">
                <a href="/"><i class="bi bi-display icon"></i></a>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" style="background:none; border: none"><i
                            class="bi bi-box-arrow-right icon"></i></button>
                </form>
            </div>
        </div>
        <div class="bottomContent flex">
            @yield('container')
        </div>
    </div>
</body>

</html>
