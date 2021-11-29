<form action="javascript:void(0);" @foreach($form['attributes'] as $key => $val) {{ $key }}="{{ $val }}" @endforeach>
{{--  表单内容  --}}
<div class="mainBox">
    <div class="main-container">
        {{ $slot }}
        @foreach($form['items'] as $item)
            <div class="layui-form-item @if($item['hidden'] ?? '') layui-hide @endif" data-id="{{$item['attributes']['id']}}">
                <label class="layui-form-label" for="{{ $item['attributes']['id'] }}">{{ $item['label']}}</label>
                <div class="layui-input-block">
                    <{{$item['element']}} @foreach($item['attributes'] as $key => $val) {{ $key }}="{{ $val }}" @endforeach></{{$item['element']}}>
                </div>
            </div>
        @endforeach
    </div>
</div>
{{-- 表单底部操作按钮  --}}
<div class="bottom">
    <div class="button-container">
        @foreach($form['actions'] as $action)
            <{{$action['element']}} @foreach($action['attributes'] as $key => $val) {{ $key }}="{{ $val }}" @endforeach>
                {!! $action['content'] !!}
            </{{$action['element']}}>
        @endforeach
    </div>
</div>
</form>