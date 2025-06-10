<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Content;
use Illuminate\Support\Str;

class Cms extends Component
{

    public string $key = '';
    public string $content = '';

    protected $rules = ['content'=>'nullable|string'];

    public function mount($key){
        $this->key = $key;
        $this->content = Content::where('key', $key)->first()?->content ?? '';
    }

   
    public function updatedContent(){

        if(!auth()->check()){
            abort(403);
        }

        $this->validate();

       Content::updateOrCreate(
        ['key' => $this->key],
        [
            'contentID'=>Str::uuid(),
            'content'=>$this->content,
        ]
        );
    }


    public function render()
    {
        return view('livewire.cms');
    }
}
