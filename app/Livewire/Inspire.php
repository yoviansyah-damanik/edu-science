<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Inspire extends Component
{
    public $quote;
    public $author;

    public function mount()
    {
        try {
            $response = Http::timeout(5)->get('http://api.quotable.io/random');

            if ($response->successful()) {
                $this->quote = $response->json('content');
                $this->author = $response->json('author');
            } else {
                $this->quote = 'Gagal memuat kutipan.';
                $this->author = '-';
            }
        } catch (\Exception $e) {
            $this->quote = 'Terjadi kesalahan: ' . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.inspire');
    }

    public function placeholder()
    {
        return view('placeholders.inspire');
    }
}
