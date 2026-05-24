<?php

namespace App\Livewire\Notes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RawViewer extends Component
{
    public function render()
    {
        $raw = DB::table('notes')->where('user_id', auth()->id())->get();
        $decrypted = auth()->user()->notes()->get();

        return view('livewire.notes.raw-viewer', compact('raw', 'decrypted'));
    }
}