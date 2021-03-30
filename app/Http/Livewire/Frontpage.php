<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;

class Frontpage extends Component
{
    public $urlslug;
    public $title;
    public $content;

    /**
     * The livewire mount function.
     * @param $urlslug
     */
    public function mount($urlslug = null) {
        $this->urlslug = $this->retrieveContent($urlslug);
    }

    /**
     * Retrieves the content of the page.
     * @param $urlslug
     */
    public function retrieveContent($urlslug) {
        // Get home page if slug is empty
        if (empty($urlslug)) {
            $data = Page::where('is_default_home', true)->first();
        } else {

            // Get the page according to the slug value
            $data = Page::where('slug', $urlslug)->first();

            // If we can't retrieve anything, let's get the default 404 not found page
            if (!$data) {
                $data = Page::where('is_default_not_found', true)->first();
            }
        }
        $this->title = $data->title;
        $this->content = $data->content;
    }

    /**
     * The livewire render function.
     * @return mixed
     */
    public function render()
    {
        return view('livewire.frontpage')->layout('layouts.frontpage');
    }
}
