<x-layadmin::layouts.base class="pear-container">
    {{--搜索区--}}
    @if($search = $page['components']['search'] ?? [])
        <div class="layui-card">
            <div class="layui-card-body">
                <form class="layui-form {{ $search['class'] ?? '' }}" action="javascript:void(0);">
                    <div class="layui-form-item">
                        @foreach($search['items'] as $k => $formItem)
                            {{-- todo 换行限制--}}
                            @if($formItem['element'] === 'laydate')
                                <div class="layui-form-item layui-inline">
                                    <label class="layui-form-label" for="{{ $formItem['id'] }}">{{ $formItem['label'] }}</label>
                                    @if($range = $formItem['range'] ?? [])
                                        <div class="layui-inline" id="{{ $formItem['id'] }}">
                                            <div class="layui-input-inline">
                                                <input type="text" id="{{ str_replace('#','',$range[0]) }}" name="{{ $formItem['name'] }}[]" class="layui-input"
                                                       placeholder="{{ $formItem['placeholder'][0] ?? '开始时间'}}"
                                                       autocomplete="off">
                                            </div>
                                            <div class="layui-form-mid">-</div>
                                            <div class="layui-input-inline">
                                                <input type="text" id="{{ str_replace('#','',$range[1]) }}" name="{{ $formItem['name'] }}[]" class="layui-input"
                                                       placeholder="{{ $formItem['placeholder'][1] ?? '结束时间'}}"
                                                       autocomplete="off">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div class="layui-form-item layui-inline">
                                    <label class="layui-form-label" for="{{ $formItem['id'] }}">{{ $formItem['label'] }}</label>
                                    <div class="layui-input-inline">
                                        @if($formItem['element'] === 'input')
                                            @switch($formItem['type'])
                                                @case('text')
                                                <input type="{{ $formItem['type'] }}" id="{{ $formItem['id'] }}" name="{{ $formItem['name'] }}"
                                                       placeholder="{{ $formItem['placeholder'] }}"
                                                       class="layui-input">
                                                @break;
                                            @endswitch
                                        @endif

                                        @if($formItem['element'] === 'select')
                                            @if($formItem['type'] === 'radio')
                                                <select name="{{ $formItem['name'] }}" id="{{ $formItem['id'] }}"></select>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        <div class="layui-form-item layui-inline">
                            <button class="pear-btn pear-btn-md pear-btn-primary" lay-submit lay-filter="{{ $search['submit']['lay-filter'] }}">
                                <i class="layui-icon {{ $search['submit']['icon'] }}"></i>
                                {{ $search['submit']['label'] }}
                            </button>
                            <button type="reset" class="pear-btn pear-btn-md">
                                <i class="layui-icon {{ $search['reset']['icon'] }}"></i>
                                {{ $search['reset']['label'] }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- 数据表格  --}}
    <div class="layui-card">
        <div class="layui-card-body">
            <table id="{{ str_replace('#','',$page['components']['table']['elem']) }}" lay-filter="{{ str_replace('#','',$page['components']['table']['elem']) }}"></table>
        </div>
    </div>

    {{ $slot }}
</x-layadmin::layouts.base>