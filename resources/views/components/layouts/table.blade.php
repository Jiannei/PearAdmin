<x-layadmin::layouts.base class="pear-container">
    @php
        // todo
        $search = $layadmin['page']['components']['search'] ?? [];

        $toolbar = $layadmin['page']['components']['table']['toolbar'] ?? [];

        $attributes = $layadmin['page']['components']['table']['attributes'] ?? [];

        $columnActions = $layadmin['page']['components']['table']['column']['actions'] ?? [];

        $table = [
            'toolbar' => $toolbar,
            'attributes' => $attributes,
            'column' => [
                'actions' => $columnActions
            ],
        ];
    @endphp

    {{-- 搜索区 --}}
    @if($search)
        <div class="layui-hide">
            <div id="LAY_SEARCH">
                <x-layadmin::form :form="$search"></x-layadmin::form>
            </div>
        </div>
    @endif

    {{-- 数据表格 --}}
    <x-layadmin::table :table="$table"></x-layadmin::table>

    {{ $slot }}
</x-layadmin::layouts.base>