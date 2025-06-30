<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\TestimonialsModel;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Exception;

class TestimonialSubmissionForm extends Component
{
    use WithFileUploads;

    public $testimonialID;
    public $name;
    public $position;
    public $company_name;
    public $testimonial_content;
    public $testimonial_submitter_picture;
    public $company_logo;
    public $is_public = false;
    public $success = '';
    public $error = '';

    public function mount() {
    
        $this->testimonialID = (string) Str::uuid();
    }


    public $validationRules = [
        'name' => 'required|string|max:255',
        'position' => 'required|max:255',
        'company_name' => 'required|string|max:255',
        'testimonial_content' => 'required|max:500',
        'testimonial_submitter_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'company_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ];

    public $validationMessages = [
        'name.required' => 'The name is required',
        'name.max' => 'The name cannot exceed 255 characters',
        'position.required' => 'Submitter\'s position is required',
        'position.max' => 'Submitter\'s position cannot exceed 255 characters',
        'company_name.required' => 'The company name is required',
        'company_name.max' => 'The company\'s name cannot exceed 255 characters',
        'testimonial_content.required' => 'Testimonial is required',
        'testimonial_content.max' => 'Testimonial cannot exceed 500 characters',
        'testimonial_submitter_picture.image' => 'The file you selected must be a valid image',
        'testimonial_submitter_picture.mimes' => 'The file selected must either be a JPG, JPEG, or PNG image',
        'testimonial_submitter_picture.max' => 'The file cannot exceed 2MB',
        'company_logo.image' => 'The file you selected must be a valid image',
        'company_logo.mimes' => 'The file selected must either be a JPG, JPEG, or PNG image',
        'company_logo.max' => 'The file cannot exceed 2MB',
        
    ];
    



    public function submitTestimonial(){

        try {
            $submitterPath = null;
            $companyLogoPath = null;

            $submitterDir = 'testimonial_submitter_pictures';
            $companyLogoDir = 'company_logos';

            // Ensure directories exist (optional, Laravel auto-creates on store)
            Storage::disk('public')->makeDirectory($submitterDir);
            Storage::disk('public')->makeDirectory($companyLogoDir);

            $this->validate($this->validationRules, $this->validationMessages);

                
                foreach([$submitterDir, $companyLogoDir] as $dir){
                   
                    if(!file_exists($dir)){

                        mkdir($dir, 0755, true);
                    }
                }

                // handle file uploads seperately depending on file chosen 
                
                if($this->testimonial_submitter_picture){
                    
                $submitterPath = $this->testimonial_submitter_picture->store($submitterDir, 'public');

                }

                if($this->company_logo) {

                $companyLogoPath = $this->company_logo->store($companyLogoDir, 'public');
            
            }
                
                $submissionData = 
                [
                    'testimonialID' => $this->testimonialID,
                    'name' => $this->name,
                    'position' => $this->position,
                    'company_name' => $this->company_name,
                    'testimonial_content' => $this->testimonial_content,
                    'testimonial_submitter_picture' => $submitterPath,
                    'company_logo' => $companyLogoPath,
                    'is_public' => $this->is_public,
                ];


                TestimonialsModel::create($submissionData);
                $this->reset(['name', 'position', 'company_name', 'testimonial_content', 'testimonial_submitter_picture', 'company_logo']);
                $successMessage = $this->is_public
                    ? 'Testimonial submitted and is available to view on the landing page.'
                    : 'Testimonial submitted but is not public. To make it viewable, edit the testimonial and check the box to make it public.';
                
                $this->success = $successMessage;
                return;
        }

       catch(Exception $e){
            $this->error = $e->getMessage();
            return;
       }
        
    }

    public function render()
    {
        return view('livewire.forms.testimonial-submission-form')->layout('layouts.app');
    }
}
