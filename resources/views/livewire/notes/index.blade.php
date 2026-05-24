<div>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">My Notes</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Your encrypted secret notes.</p>
        </div>
        <x-ui.button href="{{ route('notes.create') }}"
            icon='<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>'>
            New Note
        </x-ui.button>
    </div>

    <x-table.index>
        <x-table.header :searchable="true" />

        <table class="w-full">
            <x-table.head>
                <x-table.cell header>Title</x-table.cell>
                <x-table.cell header class="hidden md:table-cell">Status</x-table.cell>
                <x-table.cell header class="hidden lg:table-cell">Created</x-table.cell>
                <x-table.cell header class="text-center">Actions</x-table.cell>
            </x-table.head>

            <x-table.body>
                @forelse ($notes as $note)
                    <x-table.row wire:key="note-{{ $note->id }}">
                        <x-table.cell class="align-middle">
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $note->title }}</p>
                        </x-table.cell>

                        <x-table.cell class="hidden md:table-cell align-middle">
                            @if ($note->is_locked)
                                <x-ui.badge variant="warning">Locked</x-ui.badge>
                            @else
                                <x-ui.badge variant="success">Unlocked</x-ui.badge>
                            @endif
                        </x-table.cell>

                        <x-table.cell class="hidden lg:table-cell align-middle text-gray-500 dark:text-zinc-400">
                            {{ $note->created_at->diffForHumans() }}
                        </x-table.cell>

                        <x-table.cell class="text-center align-middle">
                            <div class="flex items-center justify-center gap-2">
                                <x-ui.view-button :href="route('notes.show', $note)" />
                                <x-ui.edit-button :href="route('notes.edit', $note)" />
                                <x-ui.delete-button :id="$note->id" :name="$note->title" resource="Note" />
                            </div>
                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell colspan="4" class="py-12 text-center text-gray-400 dark:text-zinc-500">
                            <svg class="mx-auto mb-3 w-10 h-10 text-gray-200 dark:text-zinc-700" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="text-sm font-medium">No notes found</p>
                            <p class="text-xs mt-1">Create your first secret note to get started.</p>
                        </x-table.cell>
                    </x-table.row>
                @endforelse
            </x-table.body>
        </table>

        <x-ui.pagination :paginator="$notes" />
    </x-table.index>
</div>
