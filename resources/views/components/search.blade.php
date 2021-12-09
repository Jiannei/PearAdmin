<form class="layui-form" action="javascript:void(0);" @foreach($form['attributes'] as $key => $val) {{ $key }}="{{ $val }}" @endforeach>
<div class="layui-form-item">
    @foreach($form['items'] as $key => $item)
        <div class="layui-inline  @if($key > 2) layui-hide @endif">
            <label class="layui-form-label" for="{{ $item['attributes']['id'] }}">{{ $item['label']}}</label>
            <div class="layui-input-inline">
                <{{$item['element']}} @foreach($item['attributes'] as $key => $val) {{ $key }}="{{ $val }}" @endforeach></{{$item['element']}}>
            </div>
        </div>
    @endforeach
    <div class="layui-inline">&emsp;
        <x-layadmin::action :actions="$form['actions']"></x-layadmin::action>
        @if(count($form['items']) > 3)
        <a class="layui-btn form-search-expand" lay-active="searchExpand">展开 <i class="layui-icon layui-icon-down"></i></a>
        @endif
    </div>
</div>
</form>