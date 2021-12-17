<form action="javascript:void(0);" @foreach($form['attributes'] as $key => $val) {{ $key }}="{{ $val }}" @endforeach>
    {{--  表单内容  --}}
    <div class="mainBox">
        <div class="main-container">
            {{ $slot }}
            @foreach($form['items'] as $item)
                @php
                    $single = \Illuminate\Support\Arr::isAssoc($item['attributes']);
                    $dataId = $single ? $item['attributes']['id'] : head($item['attributes'])['name'];
                    $required = $item['required'] ?? false;
                @endphp

                <div class="layui-form-item @if($item['hidden'] ?? '') layui-hide @endif" data-id="{{ $dataId }}">
                    <label class="layui-form-label @if($required) layui-form-required @endif" for="{{ $dataId }}">{{ $item['label']}}</label>
                    <div class="layui-input-block">
                        @if($single)
                            <{{$item['element']}} @foreach($item['attributes'] as $key => $val) {{ $key }}="{{ $val }}" @endforeach></{{$item['element']}}>
                        @else
                            @foreach($item['attributes'] as $value)
                                <{{$item['element']}} @foreach($value as $key => $val) {{ $key }}="{{ $val }}" @endforeach></{{$item['element']}}>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- 表单底部操作按钮  --}}
    <div class="bottom">
        <div class="button-container">
            <x-layadmin::action :actions="$form['actions']"></x-layadmin::action>
        </div>
    </div>
</form>