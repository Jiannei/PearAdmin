@foreach($actions as $action)
    @if(\Illuminate\Support\Arr::has($action,['hide','attributes.class']))
    @{{#
      var hide = function(d){
        let layadmin =  layui.sessionData('layadmin');;
        let pageConfig = layadmin[layadmin.current.id];

        if(pageConfig.layout !== 'table'){
           return false;
        }

        let action = '';
        layui.each(pageConfig.components.table.actions,function(key,item){
            if(item.hide !== undefined){
                action = item;
            }
        });

        if(d[action.hide.field] == action.hide.value){
            return true;
        }

        return false;
      };
    }}

    @{{# if(!hide(d)) { }}
        <{{$action['element']}} @foreach($action['attributes'] as $key => $val) {{ $key }}="{{ $val }}" @endforeach>
        @if($icon = $action['icon'] ?? '')<i class="{{ $action['icon'] }}"></i>@endif @if($label = $action['label'] ?? '') {{ $label }}@endif
        </{{$action['element']}}>
    @{{# } }}
    @else
        <{{$action['element']}} @foreach($action['attributes'] as $key => $val) {{ $key }}="{{ $val }}" @endforeach>
        @if($icon = $action['icon'] ?? '')<i class="{{ $action['icon'] }}"></i>@endif @if($label = $action['label'] ?? '') {{ $label }}@endif
        </{{$action['element']}}>
    @endif
@endforeach