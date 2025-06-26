<?php 

namespace App\Livewire\Forms;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\CMSModel;
use Illuminate\Support\Facades\Storage;

class EditContent extends Component
{
    use WithFileUploads;

    public $cms;
    public $region;
    public $content;
    public $image;
    public $existingImage;

    public $success;
    public $error;

    public function mount($contentID)
    {
        $this->cms = CMSModel::findOrFail($contentID);
        $this->region = $this->cms->region;
        $this->content = $this->cms->content;

        // Show image if the region is image-related
        if ($this->isImageRegion()) {
            $this->existingImage = $this->cms->content;
        }
    }

    public function isImageRegion()
    {
            return in_array($this->region, ['hero_background', 'why_us_image', 'cta_background_image']);

    }

    public function update()
    {
        $this->validate([
            'region' => 'required|string',
            'content' => $this->isImageRegion() ? 'nullable' : 'required|string',
            'image'   => $this->isImageRegion() ? 'nullable|image|mimes:jpg,jpeg,png|max:2048' : 'nullable',
        ]);

        if ($this->isImageRegion() && $this->image) {
            // Delete old image if exists
            if ($this->existingImage && Storage::disk('public')->exists($this->existingImage)) {
                Storage::disk('public')->delete($this->existingImage);
            }

            $this->content = $this->image->store('cms_images', 'public');
        }

        $this->cms->update([
            'region' => $this->region,
            'content' => $this->content,
        ]);

        $this->success = "Content updated successfully.";
    }

    public function render()
    {
        return view('livewire.forms.edit-content')->layout('layouts.app');
    }
}
