<x-layadmin::layouts.base>
    @if($form = config('layadmin.page.components.form',[]))
        <x-layadmin::form :form="$form"></x-layadmin::form>
    @endif

    {{ $slot }}
</x-layadmin::layouts.base>
