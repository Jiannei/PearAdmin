{{--  数据表格：表头操作 --}}
@if(count($table['toolbar']['actions'] ?? []))
<script type="text/html" id="{{ $table['attributes']['id'].'-toolbar' }}">
    <x-layadmin::action :actions="$table['toolbar']['actions']"></x-layadmin::action>
</script>
@endif

{{-- 数据表格  --}}
<div class="layui-card">
    <div class="layui-card-body">
        <table @foreach($table['attributes'] as $key => $val) {{ $key }}="{{ $val }}" @endforeach></table>
    </div>
</div>

{{-- 数据表格：行操作按钮 --}}
@if(count($table['column']['actions'] ?? []))
<script type="text/html" id="{{ $table['attributes']['id'].'-bar' }}">
    <x-layadmin::action :actions="$table['column']['actions']"></x-layadmin::action>
</script>
@endif
