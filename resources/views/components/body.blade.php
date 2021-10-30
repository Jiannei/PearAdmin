<body>
    {{ $slot }}

    <x-layadmin::script>
        {{ $script ?? '' }}
    </x-layadmin::script>
</body>