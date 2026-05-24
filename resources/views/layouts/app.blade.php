<x-layouts::app.sidebar :title="$title ?? null">
    <flux:main>
        <x-ui.confirmation-modal />
        <x-ui.toast />
        {{ $slot }}
    </flux:main>
</x-layouts::app.sidebar>
