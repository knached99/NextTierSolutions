<?php

namespace App\Livewire\CMS;

use Livewire\Component;
use App\Models\ArticlesModel;
use Illuminate\Support\Facades\Storage;


class ArticlesList extends Component
{

    public $articles;


    public function mount(){

        $this->articles = ArticlesModel::latest()->get();
    }


    public function render()
    {
        return view('livewire.cms.articles-list');
    }
}
