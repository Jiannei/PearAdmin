<x-layadmin::layouts.base class="pear-container">
    {{--搜索区--}}
    @if($search = $layadmin['page']['components']['search'] ?? [])
        <div class="layui-hide">
            <div id="LAY_SEARCH">
                <x-layadmin::form :form="$search"></x-layadmin::form>
            </div>
        </div>
    @endif

    {{--  数据表格：表头操作 --}}
    @if($toolbarId = $layadmin['page']['components']['table']['config']['toolbar'] ?? $layadmin['page']['id'].'-toolbar')
        <script type="text/html" id="{{ ltrim($toolbarId,'#') }}">
            @foreach($toolbar = $layadmin['page']['components']['table']['toolbar'] ?? [] as $item)
            <{{$item['element']}} @foreach($item['attributes'] as $key => $val) {{ $key }}="{{ $val }}" @endforeach>
            @if(is_array($item['label']))<i class="{{ $item['label']['icon'] }}"></i> {{$item['label']['text']}}@else {{$item['label']}} @endif
            </{{$item['element']}}>
            @endforeach
        </script>
    @endif

    {{-- 数据表格  --}}
    <div class="layui-card">
        <div class="layui-card-body">
            <table @foreach($layadmin['page']['components']['table']['attributes'] as $key => $val) {{ $key }}="{{ $val }}" @endforeach></table>
        </div>
    </div>

    {{-- 数据表格：行操作按钮 --}}
    @if($columnActions = $layadmin['page']['components']['table']['cols']['actions'] ?? [])
        <script type="text/html" id="{{$layadmin['page']['id']}}-bar">
            @foreach($columnActions as $action)
            <{{$action['element']}} @foreach($action['attributes'] as $key => $val) {{ $key }}="{{ $val }}" @endforeach>
            {!! $action['content'] !!}
            </{{$action['element']}}>
            @endforeach
        </script>
    @endif

    {{ $slot }}
</x-layadmin::layouts.base>