{{-- 全局 scripts --}}
@if($attributes->get('default',true))
    <link rel="stylesheet" href="{{ asset('layadmin/component/pear/css/pear.css') }}"/>
@endif

{{-- Page styles  --}}
@foreach($page['styles'] as $href)
    <link rel="stylesheet" href="{{ asset($href) }}"/>
@endforeach

{{-- User custom styles--}}
{{ $slot }}