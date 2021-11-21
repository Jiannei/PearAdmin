<x-layadmin::layouts.base>
    @push('style')
        <link rel="stylesheet" href="{{ asset("layadmin/css/error.css") }}">
    @endpush

    <div class="content">
        <img src="{{ asset('layadmin/images/404.svg') }}" alt="">
        <div class="content-r">
            <h1>404</h1>
            <p>抱歉，你访问的页面不存在或仍在开发中</p>
            <a href="{{ url(config('layadmin.home.path','/')) }}"><button class="pear-btn pear-btn-primary">返回首页</button></a>
        </div>
    </div>
</x-layadmin::layouts.base>