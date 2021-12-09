<x-layadmin::layouts.base class="pear-container">
    @php
        // todo
        $search = request('layadmin.page.components.search',[]);

        $toolbar = request('layadmin.page.components.table.toolbar',[]);

        $attributes = request('layadmin.page.components.table.attributes',[]);

        $columnActions = request('layadmin.page.components.table.column.actions',[]);

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
        <div class="layui-card">
            <div class="layui-card-body">
                <x-layadmin::search :form="$search"></x-layadmin::search>
            </div>
        </div>
    @endif

    {{-- 数据表格 --}}
    <x-layadmin::table :table="$table"></x-layadmin::table>

    {{ $slot }}
</x-layadmin::layouts.base>