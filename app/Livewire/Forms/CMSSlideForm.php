<?php 

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\CMSSlides;
use Illuminate\Support\Str;

class CmsSlideForm extends Component
{
    public $slides;
    public $title;
    public $subtitle;
    public $description;

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
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        CMSSlides::create([
            'slideID' => Str::uuid(),
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'description' => $this->description,
        ]);

        $this->reset();
        $this->loadSlides();

        session()->flash('success', 'Slide created!');
    }

    public function render()
    {
        return view('livewire.forms.cms-slide-form')->layout('layouts.app');
    }
}
