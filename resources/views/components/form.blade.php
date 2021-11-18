<form action="javascript:void(0);" @foreach($form['attributes'] as $key => $val) {{ $key }}="{{ $val }}" @endforeach>
    {{--  表单内容  --}}
    <div class="mainBox">
        <div class="main-container">
            @foreach($form['items'] as $item)
                <div class="layui-form-item">
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
                @if(is_string($action['label'])) {{ $action['label'] }} @else <i class="{{ $action['label']['icon'] }}"></i> <span>{{ $action['label']['text'] }}</span> @endif
                </{{$action['element']}}>
            @endforeach
        </div>
    </div>
</form>