{{--  数据表格：表头操作 --}}
@if(count($table['actions']['toolbar'] ?? []))
<script type="text/html" id="{{ $table['attributes']['id'].'-toolbar' }}">
    <x-layadmin::action :actions="$table['actions']['toolbar']"></x-layadmin::action>
</script>
@endif

{{-- 数据表格  --}}
<div class="layui-card">
    <div class="layui-card-body">
        <table @foreach($table['attributes'] as $key => $val) {{ $key }}="{{ $val }}" @endforeach></table>
    </div>
</div>

{{-- 数据表格：行操作按钮 --}}
@if(count($table['actions']['column'] ?? []))
<script type="text/html" id="{{ $table['attributes']['id'].'-bar' }}">
    <x-layadmin::action :actions="$table['actions']['column']"></x-layadmin::action>
</script>
@endif
