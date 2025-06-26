<?php

namespace App\Livewire\CMS;

use Livewire\Component;
use App\Models\CMSModel;

class CMSContentCards extends Component
{

    public $contentItems = [];


    public function mount() {

        $this->contentItems = CMSModel::latest()->get();    
    }


    public function render()
    {
        return view('livewire.cms.content-cards');
    }
}
