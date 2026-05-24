<?php

declare(strict_types=1);

namespace App\Livewire\Notes;

use App\Models\Note;
use App\Services\RedirectNotification;
use Livewire\Component;

class Edit extends Component
{
    public Note $note;

    public string $title = '';

    public string $body = '';

    public bool $is_locked = false;

    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'is_locked' => ['boolean'],
        ];
    }

    public function mount(Note $note): void
    {
        $this->authorize('update', $note);

        $this->note = $note;
        $this->title = $note->title;
        $this->body = $note->body;
        $this->is_locked = $note->is_locked;
    }

    public function save(): void
    {
        $this->authorize('update', $this->note);

        $validated = $this->validate();

        $this->note->update($validated);

        RedirectNotification::success('Note updated successfully.');

        $this->redirectRoute('notes.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.notes.edit');
    }
}
