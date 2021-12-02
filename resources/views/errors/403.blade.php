<x-layadmin::layouts.base>
    @push('style')
        <link rel="stylesheet" href="{{ asset("vendor/layadmin/css/error.css") }}">
    @endpush

    <div class="content">
        <img src="{{ asset('vendor/layadmin/images/403.svg') }}" alt="">
        <div class="content-r">
            <h1>403</h1>
            <p>抱歉，你无权访问该页面</p>
            <a href="{{ url(config('layadmin.home.path','/')) }}"><button class="pear-btn pear-btn-primary">返回首页</button></a>
        </div>
    </div>
</x-layadmin::layouts.base>
