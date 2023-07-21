<!DOCTYPE html>
<html lang="en">
@include('theme.partials.head')
<body class="sb-nav-fixed">
@include('theme.partials.nav')
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        @include('theme.partials.aside')
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                @yield('content')
            </div>
        </main>
        @include('theme.partials.footer')
    </div>
</div>
@include('theme.partials.scripts')
</body>
</html>
