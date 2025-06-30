<?php 

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\CMSSlides;
use Illuminate\Support\Str;
use Exception;

class CmsSlideForm extends Component
{
    public $slides;
    public $title;
    public $subtitle;
    public $description;
    public $success = '';
    public $error = '';

    public function mount(){

        $this->loadSlides();
    }

    public function loadSlides(){
        $this->slides = CMSSlides::orderBy('created_at')->get();
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        try{

        CMSSlides::create([
            'slideID' => Str::uuid(),
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'description' => $this->description,
        ]);

        $this->reset(['title', 'subtitle', 'description']);
        $this->loadSlides();

        $this->success = 'Slide created and is now available on the landing page';
        return;

    }

        catch(Exception $e){

            $this->error = $e->getMessage();
            return;
        }

     
    }

    public function render()
    {
        return view('livewire.forms.cms-slide-form')->layout('layouts.app');
    }
}
