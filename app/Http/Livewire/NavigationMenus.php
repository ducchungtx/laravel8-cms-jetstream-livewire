<?php

namespace App\Http\Livewire;

use App\Models\NavigationMenu;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class NavigationMenus extends Component
{
    use WithPagination;
    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;
    public $label;
    public $sequence = 1;
    public $slug;
    public $type = 'SidebarNav';

    /**
     * The validation rules
     *
     * @return array
     */
    public function rules()
    {
        return [
            'label' => 'required',
            'slug' => 'required',
            'sequence' => 'required',
            'type' => 'required',
        ];
    }

    /**
     * The create function.
     */
    public function create() {
        $this->validate();
        NavigationMenu::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }

    /**
     * The read function.
     * @return mixed
     */
    public function read() {
        return NavigationMenu::paginate(5);
    }

    /**
     * The update function
     */
    public function update() {
        $this->validate();
        NavigationMenu::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    /**
     * The delete function.
     */
    public function delete() {
        NavigationMenu::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    /**
     * Shows the create show modal
     */
    public function createShowModal() {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    /**
     * Show the form modal in update mode
     * @param $id
     */
    public function updateShowModal($id) {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
        $this->modelId = $id;
        $this->loadModel();
    }

    /**
     * Show the delete confirmation modal.
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
        $data = NavigationMenu::find($this->modelId);
        $this->label = $data->label;
        $this->slug = $data->slug;
        $this->type = $data->type;
        $this->sequence = $data->sequence;
    }

    public function modelData() {
        return [
            'label' => $this->label,
            'sequence' => $this->sequence,
            'type' => $this->type,
            'slug' => $this->slug
        ];
    }

    public function render()
    {
        return view('livewire.navigation-menus', [
            'data' => $this->read()
        ]);
    }
}
