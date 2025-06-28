<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\TestimonialsModel;
use Illuminate\Support\Facades\Storage;
use Exception;




class EditTestimonialForm extends Component
{
    use WithFileUploads;

    public $testimonialID, $name, $position, $company_name, $testimonial_content, $testimonial_submitter_picture, $company_logo;
    
    public $new_submitter_picture, $new_company_logo;

    public $success = '';
    public $error = '';

      protected $rules = [
        'name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'company_name' => 'required|string|max:255',
        'testimonial_content' => 'required|string|max:500',
        'new_submitter_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'new_company_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ];


    public function mount($testimonialID){
        
        $this->testimonialID = $testimonialID;

        $testimonial = TestimonialsModel::findOrFail($this->testimonialID);

        $this->name = $testimonial->name;
        $this->position = $testimonial->position;
        $this->company_name = $testimonial->company_name;
        $this->testimonial_content = $testimonial->testimonial_content;
        $this->testimonial_submitter_picture = $testimonial->testimonial_submitter_picture;
        $this->company_logo = $testimonial->company_logo;

    }


    public function updateTestimonial(){

        $this->validate();

        try { 

            $testimonial = TestimonialsModel::findOrFail($this->testimonialID);

            $testimonial->name = $this->name;
            $testimonial->position = $this->position;
            $testimonial->company_name = $this->company_name;
            $testimonial->testimonial_content = $this->testimonial_content;

            if($this->new_submitter_picture) {

                if($testimonial->testimonial_submitter_picture && Storage::disk('public')->exists($testimonial->testimonial_submitter_picture)){
                    Storage::disk('public')->delete($testimonial->testimonial_submitter_picture);
                }

                $testimonial->testimonial_submitter_picture = $this->new_submitter_picture->store('testimonial_submitter_pictures', 'public');
            }

            if($this->new_company_logo){

                if($testimonial->company_logo && Storage::disk('public')->exists($testimonial->company_logo)){

                    Storage::disk('public')->delete($testimonial->company_logo);
                }

                $testimonial->company_logo = $this->new_company_logo->store('company_logos', 'public');

            }

            $testimonial->save();

            $this->success = 'Testimonial updated successfully!';
            $this->reset(['new_submitter_picture', 'new_company_logo']);
            
        }

        catch(Exception $e){
         
            $this->error = 'Error updating testimonial: ' . $e->getMessage();

        }
    }

    public function render()
    {
        return view('livewire.forms.edit-testimonial-form')->layout('layouts.app');
    }
}
