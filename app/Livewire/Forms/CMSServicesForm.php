<?php 

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\Services;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CMSServicesForm extends Component
{
    public string $serviceID = '';
    public $services;
    public $css;
    public $icons = [];
    public $icon;
    public $title, $description, $icon_class, $icon_color = '#000', $order, $serviceId;
    public string $success = '';
    public string $error = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'icon_class' => 'required|string|max:255',
        'icon_color' => 'required|string|max:7', 
        'order' => 'required|integer',
    ];

    public function mount()
{
    $cssPath = public_path('assets/vendor/bootstrap-icons/bootstrap-icons.css');

    if (file_exists($cssPath)) {
        $css = file_get_contents($cssPath);

        preg_match_all('/\.bi-([a-z0-9-]+)::before/', $css, $matches);

        $this->icons = array_map(function ($match) {
            return 'bi-' . $match;
        }, $matches[1]);

        $this->serviceID = Str::uuid();
        
    }

    $this->loadServices();
}


    public function loadServices()
    {
        $this->services = Services::orderBy('order')->get();
    }

    public function resetForm()
    {
        $this->serviceId = null;
        $this->title = '';
        $this->description = '';
        $this->icon_class = '';
        $this->icon_color = '';
        $this->order = null;
    }

    public function edit(Service $service)
    {
        $this->serviceID = $service->serviceID;
        $this->title = $service->title;
        $this->description = $service->description;
        $this->icon_class = $service->icon_class;
        $this->icon_color = $service->icon_color;
        $this->order = $service->order;
    }

    public function save()
    {
        \Log::info('Checking if user selected icon color');

        if(empty($this->icon_color)){
            $this->icon_color = '#000';
            \Log::info('User has not chosen icon color, defaulting to '.$this->icon_color);
        }
        
        \Log::info('Icon color chosen: '.$this->icon_color);

        \Log::info('Validating user input..');
        $this->validate();

        \Log::info('User input validated!');

        // if ($this->serviceId) {
        //     $service = Services::find($this->serviceId);
        //     $service->updateOrCreate(
        //         ['serviceID' => $this->serviceID],
        //         [
        //         'title' => $this->title,
        //         'description' => $this->description,
        //         'icon_class' => $this->icon_class,
        //         'icon_color' => $this->icon_color,
        //         'link' => $this->link,
        //         'order' => $this->order,
        //     ]);
        // } else {
        //     Services::create([
        //         'title' => $this->title,
        //         'description' => $this->description,
        //         'icon_class' => $this->icon_class,
        //         'icon_color' => $this->icon_color,
        //         'link' => $this->link,
        //         'order' => $this->order,
        //     ]);
        // }

    try {

    \Log::info('Upserting Services Model...');

    Services::updateOrCreate(
    ['serviceID' => $this->serviceID], // Search by this key
    [
        'title' => $this->title,
        'description' => $this->description,
        'icon_class' => $this->icon_class,
        'icon_color' => $this->icon_color ?: '#000',
        'order' => $this->order,
    ]
);

        $this->resetForm();
        $this->loadServices();
        \Log::info('Services Model upserted successfully!');
        $this->success = 'Service saved and is available on the landing page!';
    }

    catch(\Exception $e){
        $this->error = $e->getMessage();   
        \Log::error('Unable to upsert Service model, the following exception was encountered: '.$e->getMessage());
    }

}

    public function delete(Service $service)
    {
        $service->delete();
        $this->loadServices();
        session()->flash('success', 'Service deleted!');
    }

    public function render()
    {
        return view('livewire.forms.cms-services-form')->layout('layouts.app');
    }
}
