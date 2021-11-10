<x-layadmin::layouts.base>
    <form class="layui-form" action="javascript:void(0);" lay-filter="tool-debug">
        {{--  表单内容  --}}
        <div class="mainBox">
            <div class="main-container">
                <div class="layui-form-item">
                    <textarea class="debug layui-textarea layui-bg-black" name="config" id="Lay-debug"></textarea>
                </div>
            </div>
        </div>
        {{-- 表单底部操作按钮  --}}
        <div class="bottom">
            <div class="button-container">
                <button type="submit" class="pear-btn pear-btn-primary pear-btn-sm" lay-submit lay-filter="tool-debug-submit">
                    <i class="layui-icon layui-icon-ok"></i>
                    保存
                </button>
                <button class="pear-btn pear-btn-sm" lay-active="restore">
                    <i class="layui-icon layui-icon-refresh"></i>
                    还原
                </button>
            </div>
        </div>
    </form>
</x-layadmin::layouts.base>