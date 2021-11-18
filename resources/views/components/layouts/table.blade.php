<x-layadmin::layouts.base class="pear-container">
    {{--搜索区--}}
    @if($search = $layadmin['page']['components']['search'] ?? [])
        <div class="layui-hide">
            <div id="LAY_SEARCH">
                <x-layadmin::form :form="$search"></x-layadmin::form>
            </div>
        </div>
    @endif

    {{-- 数据表格  --}}
    <div class="layui-card">
        <div class="layui-card-body">
            <table @foreach($layadmin['page']['components']['table']['attributes'] as $key => $val) {{ $key }}="{{ $val }}" @endforeach></table>
        </div>
    </div>

    {{ $slot }}
</x-layadmin::layouts.base>