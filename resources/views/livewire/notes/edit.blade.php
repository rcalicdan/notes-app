<div>
    <x-form.card title="Edit Note" description="Changes to the note body will be re-encrypted on save.">
        <x-form.grid :cols="1">
            <div>
                <x-form.label required>Title</x-form.label>
                <x-form.input
                    wire:model="title"
                    placeholder="Enter note title"
                />
            </div>

            <div>
                <x-form.label required>Body</x-form.label>
                <x-form.text-area
                    wire:model="body"
                    placeholder="Write your secret note here..."
                    :rows="6"
                />
            </div>

            <div class="flex items-center gap-3">
                <input
                    type="checkbox"
                    wire:model="is_locked"
                    id="is_locked"
                    class="w-4 h-4 rounded border-gray-300 text-red-600 focus:ring-red-600"
                >
                <div>
                    <x-form.label for="is_locked" class="mb-0">Lock this note</x-form.label>
                    <p class="text-xs text-gray-400 dark:text-zinc-500 mt-0.5">
                        Requires password re-entry to view the note content.
                    </p>
                </div>
            </div>
        </x-form.grid>

        <x-slot:footer>
            <div class="flex items-center gap-3">
                <x-ui.button wire:click="save" variant="primary">
                    Update Note
                </x-ui.button>
                <x-ui.button href="{{ route('notes.index') }}" variant="secondary">
                    Cancel
                </x-ui.button>
            </div>
        </x-slot:footer>
    </x-form.card>
</div>