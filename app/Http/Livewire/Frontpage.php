<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Frontpage extends Component
{
    public $urlslug;
    public $title;
    public $content;

    public function mount($urlslug) {
        $this->urlslug = $urlslug;
    }

    public function render()
    {
        return view('livewire.frontpage')->layout('layouts.frontpage');
    }
}
