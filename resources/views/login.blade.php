<x-layadmin::layouts.base background="{{ asset('/admin/images/background.svg') }}" style="background-size: cover;">
    <form class="layui-form" action="javascript:void(0);">
        <div class="layui-form-item">
            <img class="logo" src="{{ asset('/admin/images/logo.png') }}"/>
            <div class="title">Lay Admin</div>
            <div class="desc">
                江 夏 区 最 具 影 响 力 的 设 计 规 范 之 一
            </div>
        </div>
        <div class="layui-form-item">
            <input placeholder="账 户 : admin " lay-verify="required" hover class="layui-input"/>
        </div>
        <div class="layui-form-item">
            <input placeholder="密 码 : admin " lay-verify="required" hover class="layui-input"/>
        </div>
        <div class="layui-form-item">
            <input placeholder="验证码 : " hover lay-verify="required" class="code layui-input layui-input-inline"/>
            <img src="{{ asset('admin/images/captcha.gif') }}" class="codeImage"/>
        </div>
        <div class="layui-form-item">
            <input type="checkbox" name="" title="记住密码" lay-skin="primary" checked>
        </div>
        <div class="layui-form-item">
            <button type="button" class="pear-btn pear-btn-success login" lay-submit lay-filter="login">
                登 入
            </button>
        </div>
    </form>
</x-layadmin::layouts.base>