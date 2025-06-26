<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Livewire\Forms\CmsForm;
use App\Livewire\Forms\EditContent;
use App\Livewire\Forms\CmsSlideForm;
use App\Livewire\Forms\CMSServicesForm;
use App\Livewire\Forms\EditServicesForm;
use App\Http\Controllers\IconsController;

// Route::get('/', function () {
//     return view('landing');
// })->name('home');

Route::get('/', [Home::class, 'landing'])->name('home');

Route::get('/contact', [Home::class, 'contactPage'])->name('contact');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // CMS Routes
    // Route::get('/dashboard/cms', \App\Http\Livewire\Cms\Index::class)->name('cms.index');

    // Route::get('/dashboard/cms/create', \App\Http\Livewire\Cms\Create::class)->name('cms.create');

    Route::get('/dashboard/cms/content/createContent', CmsForm::class)->name('cms.content.createContent');
    Route::get('/dashboard/cms/content/{contentID}/editContent', EditContent::class)->name('cms.content.editContent');
    Route::get('/dashboard/cms/slides/createSlide', CmsSlideForm::class)->name('cms.slides.cms-slide-form');
    Route::get('/dashboard/cms/service/createService', CMSServicesForm::class)->name('cms.service.cms-service-form');
    Route::get('/dashboard/cms/service/{serviceID}/editService', EditServicesForm::class)->name('cms.service.edit-service');
    Route::get('/icons.json', [IconsController::class, 'json'])->name('icons.json');

});

