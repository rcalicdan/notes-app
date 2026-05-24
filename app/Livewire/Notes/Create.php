<?php

declare(strict_types=1);

namespace App\Livewire\Notes;

use App\Models\Note;
use App\Services\RedirectNotification;
use Livewire\Component;

class Create extends Component
{
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

    public function save(): void
    {
        $this->authorize('create', Note::class);

        $validated = $this->validate();

        auth()->user()->notes()->create($validated);

        RedirectNotification::success('Note created successfully.');

        $this->redirectRoute('notes.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.notes.create');
    }
}
