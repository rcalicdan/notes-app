<?php

declare(strict_types=1);

namespace App\Livewire\Notes;

use App\Models\Note;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function delete(Note $note): void
    {
        $this->authorize('delete', $note);

        $note->delete();

        $this->dispatch('notify', message: 'Note deleted successfully.', type: 'success');
    }

    public function render()
    {
        $notes = Note::forUser(auth()->user())
            ->when($this->search, fn ($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->latest()
            ->paginate(10)
        ;

        return view('livewire.notes.index', compact('notes'));
    }
}
