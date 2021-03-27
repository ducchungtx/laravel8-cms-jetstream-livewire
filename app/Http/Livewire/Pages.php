<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Pages extends Component
{
    use WithPagination;
    public $modalFormVisiable = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;
    public $slug;
    public $title;
    public $content;

    /**
     * The validation rules
     * @return array
     */
    public function rules() {
        return [
            'title' => 'required',
            'slug' => ['required', Rule::unique('pages', 'slug')->ignore($this->modelId)],
            'content' => 'required'
        ];
    }

    /**
     * The livewire mount function
     */
    public function mount() {
        // Reset the pagination after reload the page
        $this->resetPage();

    }

    /**
     * Runs everytime the title variable is updated
     * @param $value
     */
    public function updatedTitle($value) {
        $this->slug = Str::slug($value);
    }

    /**
     * The create function
     */
    public function create() {
        $this->validate();
        Page::create($this->modelData());
        $this->modalFormVisiable = false;
        $this->resetVars();
    }

    /**
     * The read function.
     * @return mixed
     */
    public function read() {
        return Page::paginate(5);
    }

    public function update() {
        $this->validate();
        Page::find($this->modelId)->update($this->modelData());
        $this->modalFormVisiable = false;
    }

    public function delete() {
        Page::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    /**
     * Show the form modal of the create function.
     */
    public function createShowModal() {
        $this->resetValidation();
        $this->resetVars();
        $this->modalFormVisiable = true;
    }

    /**
     * Show the form modal in update model.
     * @param $id
     */
    public function updateShowModal($id) {
        $this->resetValidation();
        $this->resetVars();
        $this->modelId = $id;
        $this->modalFormVisiable = true;
        $this->loadModel();
    }

    /**
     * Shows the delete confirmation modal of the delete function
     * @param $id
     */
    public function deleteShowModal($id) {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    /**
     * Load the model data of this component
     */
    public function loadModel() {
        $data = Page::find($this->modelId);
        $this->title = $data->title;
        $this->slug = $data->slug;
        $this->content = $data->content;
    }

    /**
     * The data for the model mapped in this component
     * @return array
     */
    public function modelData() {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content
        ];
    }

    /**
     * Reset all the variables to null.
     */
    public function resetVars() {
        $this->modelId = null;
        $this->title = null;
        $this->slug = null;
        $this->content = null;
    }

    /**
     * The livewire render funtion.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.pages', [
            'data' => $this->read()
        ]);
    }
}
