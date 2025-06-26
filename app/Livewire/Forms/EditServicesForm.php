<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\Services; 

class EditServicesForm extends Component
{

    public $service;
    public string $css; 
    public array $icons = [];
    public string $icon; 
    public $title, $description, $icon_class, $icon_color = '#000', $link, $order, $serviceId;
    public string $success = '';
    public string $error = '';

      protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'icon_class' => 'required|string|max:255',
        'icon_color' => 'required|string|max:7', 
        'link' => 'required|url',
        'order' => 'required|integer',
    ];


    public function mount($serviceID){
        
        $this->service = Services::findOrFail($serviceID);
        $this->serviceID = $this->service->serviceID;
        $this->title = $this->service->title;
        $this->description = $this->service->description;
        $this->icon_class = $this->service->icon_class;
        $this->icon_color = $this->service->icon_color;
        $this->link = $this->service->link;
        $this->order = $this->service->order;
}
        
    

    public function editService(){

    }

    public function render()
    {
        return view('livewire.forms.edit-services-form')->layout('layouts.app');
    }
}
