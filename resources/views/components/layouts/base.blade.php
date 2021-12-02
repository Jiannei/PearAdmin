<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{{ config('layadmin.page.title',config('layadmin.title'))}}</title>

    {{-- 全局 styles --}}
    <link rel="stylesheet" href="{{ asset('vendor/layadmin/component/pear/css/pear.css') }}"/>

    {{-- Page styles  --}}
    @foreach(config('layadmin.page.styles',[]) as $href)
        <link rel="stylesheet" href="{{ asset($href) }}"/>
    @endforeach

    {{-- 自定义 CSS   --}}
    @stack('style')
</head>
<body class="{{ $attributes->get('class') }}" background="{{ $attributes->get('background') }}" style="{{ $attributes->get('style') }}">
    {{ $slot }}

    {{-- 全局 scripts --}}
    <script src="{{ asset('vendor/layadmin/component/layui/layui.js') }}"></script>
    <script src="{{ asset('vendor/layadmin/component/pear/pear.js') }}"></script>
    <script src="{{ asset('vendor/layadmin/component/lodash.min.js') }}"></script>
    <script>
      window.layadmin = @json(config('layadmin'),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
      localStorage.setItem('layadmin',JSON.stringify(window.layadmin));
    </script>

    {{-- Page scripts  --}}
    <script src="{{ asset('vendor/layadmin/component/app.js') }}"></script>
    @foreach(config('layadmin.page.scripts',[]) as $src)
        <script src="{{ asset($src) }}"></script>
    @endforeach

    {{--自定义 scripts--}}
    @stack('script')
</body>
</html>
