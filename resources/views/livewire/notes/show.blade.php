<div>
    <x-form.card>
        <x-slot:title>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                        {{ $note->title }}
                    </h3>
                    @if ($note->is_locked)
                        <x-ui.badge variant="warning">Locked</x-ui.badge>
                    @else
                        <x-ui.badge variant="success">Unlocked</x-ui.badge>
                    @endif
                </div>
                <div class="flex items-center gap-2">
                    <x-ui.edit-button :href="route('notes.edit', $note)" />
                    <x-ui.button href="{{ route('notes.index') }}" variant="secondary" size="sm">
                        Back
                    </x-ui.button>
                </div>
            </div>
        </x-slot:title>

        @if ($unlocked)
            <div class="prose dark:prose-invert max-w-none">
                <div class="p-4 bg-gray-50 dark:bg-zinc-800 rounded-xl text-sm text-gray-700 dark:text-zinc-300 leading-relaxed whitespace-pre-wrap">
                    {{ $note->body }}
                </div>
            </div>

            <div class="mt-4 p-3 bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 rounded-xl flex items-center gap-2">
                <svg class="w-4 h-4 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                </svg>
                <p class="text-xs text-green-700 dark:text-green-400 font-medium">
                    This content was decrypted in real time and is never stored in plain text.
                </p>
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-8 gap-6">
                <div class="flex flex-col items-center gap-2 text-center">
                    <div class="w-14 h-14 rounded-full bg-yellow-50 dark:bg-yellow-900/20 flex items-center justify-center">
                        <svg class="w-7 h-7 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zM10 9V7a2 2 0 114 0v2m-4 0h4" />
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-gray-700 dark:text-zinc-300">This note is locked</p>
                    <p class="text-xs text-gray-400 dark:text-zinc-500">Enter your account password to decrypt and view the content.</p>
                </div>

                <div class="w-full max-w-sm space-y-3">
                    <div>
                        <x-form.label>Account Password</x-form.label>
                        <x-form.password
                            wire:model="password"
                            wire:keydown.enter="unlock"
                            placeholder="Enter your password"
                        />
                        @error('password')
                            <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <x-ui.button wire:click="unlock" variant="primary" class="w-full">
                        Unlock Note
                    </x-ui.button>
                </div>
            </div>
        @endif

        <x-slot:footer>
            <p class="text-xs text-gray-400 dark:text-zinc-500">
                Created {{ $note->created_at->format('M d, Y \a\t h:i A') }}
                &middot; Last updated {{ $note->updated_at->diffForHumans() }}
            </p>
        </x-slot:footer>
    </x-form.card>
</div>