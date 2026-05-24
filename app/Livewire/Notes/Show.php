<?php

declare(strict_types=1);

namespace App\Livewire\Notes;

use App\Models\Note;
use App\Models\NoteUnlockAttempt;
use Livewire\Component;

class Show extends Component
{
    public Note $note;

    public bool $unlocked = false;

    public string $password = '';

    public function mount(Note $note): void
    {
        $this->authorize('view', $note);

        $this->note = $note;
        $this->unlocked = ! $note->is_locked;
    }

    public function unlock(): void
    {
        $this->authorize('view', $this->note);

        $successful = password_verify($this->password, auth()->user()->password);

        NoteUnlockAttempt::create([
            'note_id' => $this->note->id,
            'user_id' => auth()->id(),
            'successful' => $successful,
            'ip_address' => request()->ip(),
            'attempted_at' => now(),
        ]);

        if (! $successful) {
            $this->addError('password', 'Incorrect password.');
            $this->password = '';

            return;
        }

        $this->unlocked = true;
        $this->password = '';
        $this->resetErrorBag();

        $this->dispatch('notify', message: 'Note unlocked successfully.', type: 'success');
    }

    public function render()
    {
        return view('livewire.notes.show');
    }
}
