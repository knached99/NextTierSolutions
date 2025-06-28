<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\CMSSlides;
use Exception;

class EditSlidesForm extends Component
{

    public $slide; 
    
    public $slideID, $title, $subtitle, $description;
    public string $success = '';
    public string $error = '';

    public $rules = [
        'title' => 'required|string|max:256',
        'subtitle' => 'required|string|max:256',
        'description' => 'required|string|max:500',
    ];


    public function mount($slideID){
        $this->slide = CMSSlides::findOrFail($slideID);
        $this->slideID = $this->slide->slideID;
        $this->title = $this->slide->title;
        $this->subtitle = $this->slide->subtitle;
        $this->description = $this->slide->description;
    }


    public function save() {

        $this->validate();

        try {

            $this->slide->update([
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'description' => $this->description,
            ]);

            $this->success = 'Your changes have been saved.';
            return;
        }

        catch(Exception $e){
            $this->error = $e->getMessage();
            return;
        }
    }

    public function render()
    {
        return view('livewire.forms.edit-slides-form')->layout('layouts.app');
    }
}
