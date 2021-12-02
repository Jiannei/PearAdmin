@foreach($actions as $action)
    <{{$action['element']}} @foreach($action['attributes'] as $key => $val) {{ $key }}="{{ $val }}" @endforeach>
    @if($icon = $action['icon'] ?? '')<i class="{{ $action['icon'] }}"></i>@endif @if($label = $action['label'] ?? '') {{ $label }}@endif
    </{{$action['element']}}>
@endforeach