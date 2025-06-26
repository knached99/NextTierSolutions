<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\CMSModel;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CmsForm extends Component
{
    use WithFileUploads;

    public $contentID;
    public $region;
    public $availableRegions = [];
    public $content;
    public $image;
    public $existingImage; // For preview if needed

    public $success = '';
    public $error = '';

    public $regions = [
        'hero_background' => 'Hero Background Image',
        'hero_title' => 'Hero Title',
        'hero_description' => 'Hero Description',
        'why_us_image' => 'Why Us Background Image',
        'our_services_title' => 'Our Services Title',
        'our_services_description' => 'Our Services Description',
        'cta_background_image' => 'Call to Action background image',
        'cta_title' => 'Call to action title',
        'cta_description' => 'Call to action description',
    ];

    public function mount()
    {
        $usedRegions = CMSModel::pluck('region')->toArray();
        
        $this->contentID = (string) Str::uuid();

        // Prepare available regions, excluding those already used
        $this->availableRegions = collect($this->regions)
            ->reject(function ($label, $regionKey) use ($usedRegions) {
                return in_array($regionKey, $usedRegions);
            })
            ->all();

        if ($this->isImageRegion()) {
        
        }
    }

    // Method, not property! Use () when calling this.
    public function isImageRegion()
    {
        return in_array($this->region, ['hero_background', 'why_us_image', 'cta_background_image']);
    }

    public function save()
    {
        try {
            $this->validate([
                'region' => 'required|string',
                // Call isImageRegion() as method with ()
                'content' => $this->isImageRegion() ? 'nullable' : 'required|string',
                'image' => $this->isImageRegion() ? 'nullable|image|mimes:jpg,jpeg,png|max:2048' : 'nullable',
            ]);

            $key = Str::slug($this->region) . '-' . now()->timestamp;

            if ($this->isImageRegion() && $this->image) {
                $path = $this->image->store('cms_images', 'public');
                $contentValue = $path;
                $this->existingImage = $path; // For preview
            } else {
                $contentValue = $this->content;
            }

            CMSModel::create([
                'contentID' => $this->contentID,
                'key' => $key,
                'region' => $this->region,
                'content' => $contentValue,
            ]);

            $this->reset(['region', 'content', 'image', 'existingImage']);

            $this->success = 'Content saved successfully!';

            return redirect()->to('/dashboard/cms/content/' . $this->contentID . '/editContent')
                ->with('success', 'Content saved successfully, continue making edits here');

        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.forms.cms-form')->layout('layouts.app');
    }
}
