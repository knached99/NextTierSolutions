<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\ArticlesModel;
use Exception;


class ArticlePostForm extends Component
{

    use WithFileUploads;

    public $articleID;
    public $post_image;
    public $post_title;
    public $slug;
    public $post_content;
    public $success = '';
    public $error = '';

    public $rules = [
        'post_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'post_title' => 'required|string|max:255',
        'post_content' => 'required|string',
    ];

     protected $messages = [
        'post_title.required' => 'Title is required.',
        'post_title.max' => 'Title cannot exceed 255 characters.',
        'post_content.required' => 'Content is required.',
        'post_image.image' => 'The uploaded file must be an image.',
        'post_image.mimes' => 'Only JPG, JPEG, or PNG files are allowed.',
        'post_image.max' => 'Image cannot exceed 2MB.',
    ];

    public function mount(){
        
        $this->articleID = (string) Str::uuid();
    }

    public function updatedPostTitle($value){

        $this->slug = Str::slug($value);
    }

    public function submitArticle() {

        $this->validate();


        try { 

            $imagePath = null;

            if($this->post_image) {
                $imagePath = $this->post_image->store('article_images', 'public');
            }

            $articleData = [
                'articleID' => $this->articleID,
                'title' => $this->post_title,
                'slug' => $this->slug,
                'content' => $this->post_content,
                'article_post_image_path' => $imagePath,
            ];


            ArticlesModel::create($articleData);

            $this->reset(['post_image', 'post_title', 'post_content']);
            $this->success = 'Article posted successfully!';
            return;
        }

        catch(Exception $e){
            $this->error = 'An error occurred: '.$e->getMessage();
        }
    }


    public function render()
    {
        return view('livewire.forms.article-post-form')->layout('layouts.app');
    }
}




