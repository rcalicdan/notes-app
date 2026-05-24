<div class="space-y-6">
    <div
        class="p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl flex items-start gap-3">
        <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
        <div>
            <p class="text-sm font-bold text-yellow-800 dark:text-yellow-400">Demo-only page</p>
            <p class="text-xs text-yellow-700 dark:text-yellow-500 mt-0.5">
                This page exists to demonstrate the difference between raw encrypted database values and decrypted model
                output.
            </p>
        </div>
    </div>

    @foreach ($decrypted as $note)
        <x-form.card>
            <x-slot:title>
                <div class="flex items-center gap-2">
                    <span class="text-base font-bold text-gray-800 dark:text-white">{{ $note->title }}</span>
                    @if ($note->is_locked)
                        <x-ui.badge variant="warning">Locked</x-ui.badge>
                    @else
                        <x-ui.badge variant="success">Unlocked</x-ui.badge>
                    @endif
                </div>
            </x-slot:title>

            <x-form.grid :cols="2">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span
                            class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-red-100 text-red-700">
                            Raw DB Value
                        </span>
                        <span class="text-[10px] text-gray-400 dark:text-zinc-500">What an attacker sees</span>
                    </div>
                    <div class="p-3 bg-gray-900 dark:bg-zinc-950 rounded-xl overflow-x-auto">
                        <pre class="text-[11px] text-red-400 whitespace-pre-wrap break-all leading-relaxed">{{ $raw->firstWhere('id', $note->id)->body }}</pre>
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span
                            class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-green-100 text-green-700">
                            Decrypted Value
                        </span>
                        <span class="text-[10px] text-gray-400 dark:text-zinc-500">What the app sees</span>
                    </div>
                    <div class="p-3 bg-gray-900 dark:bg-zinc-950 rounded-xl overflow-x-auto">
                        <pre class="text-[11px] text-green-400 whitespace-pre-wrap break-all leading-relaxed">{{ $note->body }}</pre>
                    </div>
                </div>
            </x-form.grid>

            <x-slot:footer>
                <p class="text-xs text-gray-400 dark:text-zinc-500">
                    Note ID: {{ $note->id }} &middot; Created {{ $note->created_at->format('M d, Y \a\t h:i A') }}
                </p>
            </x-slot:footer>
        </x-form.card>
    @endforeach

    @if ($decrypted->isEmpty())
        <x-form.card>
            <div class="flex flex-col items-center justify-center py-10 text-gray-400 dark:text-zinc-500">
                <p class="text-sm font-medium">No notes yet</p>
                <p class="text-xs mt-1">Create a note first to see the encryption comparison.</p>
                <x-ui.button href="{{ route('notes.create') }}" variant="primary" size="sm" class="mt-4">
                    Create a Note
                </x-ui.button>
            </div>
        </x-form.card>
    @endif
</div>
