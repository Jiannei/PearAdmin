<x-layadmin::layouts.base>
    @push('style')
        <link rel="stylesheet" href="{{ asset("layadmin/css/error.css") }}">
    @endpush

    <div class="content">
        <img src="{{ asset('layadmin/images/500.svg') }}" alt="">
        <div class="content-r">
            <h1>500</h1>
            <p>抱歉，服务器出错了</p>
            @env('local')
                @error('page','layadmin')
                <textarea id="page-error" class="layui-textarea layui-bg-black">{{ $message }}</textarea>
                @enderror
            @endenv
        </div>
    </div>
</x-layadmin::layouts.base>