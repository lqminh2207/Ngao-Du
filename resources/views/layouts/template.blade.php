<!DOCTYPE html>
<html lang="en">
    @yield('css') 
    @include('elements.meta')
    <title>@yield('title')</title>
<body>
    @yield('header')
    
    <main>  
        @yield('content')
    </main>

    @include('elements.footer')
    
    @stack('scripts')
    @include('elements.scripts')
</body>
</html>