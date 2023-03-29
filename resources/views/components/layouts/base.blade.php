<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="{{ config('layadmin.desc') }}">
    <title>{{ request('layadmin.page.title') }}</title>

    {{-- 全局 styles --}}
    <link rel="stylesheet" href="{{ asset('vendor/layadmin/component/pear/css/pear.css') }}"/>

    {{-- Page styles  --}}
    @foreach( request('layadmin.page.styles',[]) as $href)
        <link rel="stylesheet" href="{{ asset($href) }}"/>
    @endforeach

    {{-- 自定义 CSS   --}}
    @stack('style')

    @routes
</head>
<body class="{{ $attributes->get('class') }}" background="{{ $attributes->get('background') }}" style="{{ $attributes->get('style') }}">
    {{ $slot }}

    {{-- 全局 scripts --}}
    <script src="{{ asset('vendor/layadmin/component/layui/layui.js') }}"></script>
    <script src="{{ asset('vendor/layadmin/component/pear/pear.js') }}"></script>
    <script>
      layui.sessionData('layadmin',{
        key:'version',
        value: '{{ request('layadmin.version') }}'
      });

      layui.sessionData('layadmin',{
        key:'config',
        value: @json(config('layadmin'))
      });

      layui.sessionData('layadmin',{
        key:'{{ request('layadmin.page.id') }}',
        value: @json( request('layadmin.page'))
      });

      layui.sessionData('layadmin',{
        key:'current',
        value: {
          id : '{{ request('layadmin.page.id') }}',
          params: @json(request('layadmin.params'))
        }
      })
    </script>

    {{-- Page scripts  --}}
    <script src="{{ asset('vendor/layadmin/component/app.js') }}"></script>
    @foreach(request('layadmin.page.scripts',[]) as $src)
        <script src="{{ asset($src) }}"></script>
    @endforeach

    {{--自定义 scripts--}}
    @stack('script')
</body>
</html>
