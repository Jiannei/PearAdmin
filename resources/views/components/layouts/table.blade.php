<x-layadmin::layouts.base class="pear-container">
    {{--搜索区--}}
    @if($search = $page['components']['search'] ?? [])
        <div class="layui-card">
            <div class="layui-card-body">
                <form class="layui-form {{ $search['class'] ?? '' }}" action="javascript:void(0);">
                    <div class="layui-form-item">
                        @foreach($search['items'] as $k => $formItem)
                            {{-- todo 换行限制--}}
                            <div class="layui-form-item layui-inline">
                                <label class="layui-form-label" for="{{ $formItem['id'] }}">{{ $formItem['label'] }}</label>
                                <div class="layui-input-inline">
                                    @switch($formItem['type'])
                                        @case('text')
                                        <input type="{{ $formItem['type'] }}" id="{{ $formItem['id'] }}" name="{{ $formItem['name'] }}" placeholder="{{ $formItem['placeholder'] }}"
                                               class="layui-input">
                                        @break;
                                    @endswitch
                                </div>
                            </div>
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