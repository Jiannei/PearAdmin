{{-- 全局 scripts --}}
@if($attributes->get('default',true))
    <script src="{{ asset('layadmin/component/layui/layui.js') }}"></script>
    <script src="{{ asset('layadmin/component/pear/pear.js') }}"></script>
@endif

{{-- Page scripts  --}}
@foreach($page['scripts'] as $src)
    <script src="{{ asset($src) }}"></script>
@endforeach

{{-- User custom scripts--}}
{{ $slot }}