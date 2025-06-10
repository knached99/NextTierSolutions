<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Carbon\Carbon;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ContactEmailNotification;
use Exception;

class Contact extends Component
{

    use UsesSpamProtection;

    public string $name = '';
    public string $businessName = '';
    public string $businessEmail = '';
    public string $businessNumber = '';
    public string $subject = '';
    public string $message = '';
    public string $successMessage = '';
    public string $errorMessage = '';


    public $rules = [
        'name'=>'required|string',
        'businessName'=>'required|string',
        'businessEmail'=>'required|string|email',
        'businessNumber'=>'required|regex:/^\d{3}-\d{3}-\d{4}$/',
        'subject'=>'required|string',
        'message'=>'required|max:5000',
    ];

    public $messages = [
        'name.required'=>'Your name is required',
        'businessName.required'=>'The name of your business is required',
        'businessEmail.required'=>'Your business email is required',
        'businessEmail.email'=>'You\'ve entered an invalid business email',
        'businessNumber.required'=>'The business number is required',
        'businessNumber.regex'=>'That is not a valid phone number',
        'subject.required'=>'You need to provide a subject',
        'message.required'=>'Please tell us why you\'re reaching out',
        'message.max'=>'Your message cannot exceed 5000 characters',
    ];

    public HoneypotData $extraFields;

    
    public function mount(){

        $this->extraFields = new HoneypotData();
    }


    public function submitContactForm(): void {

        $this->validate();
        $this->protectAgainstSpam();

        try {
         
              $data = [
                'name'=>$this->name,
                'businessName'=>$this->businessName,
                'businessEmail'=>$this->businessEmail,
                'businessNumber'=>$this->businessNumber,
                'subject'=>$this->subject,
                'message'=>$this->message,
                'submittedOn'=> date('F jS, Y \a\t g:i A', strtotime(Carbon::now())), 
            ];

            $recipientEmail = config('mail.from.address');
            
            $notificationClass = ContactEmailNotification::class;

            $this->sendNotification($data, $recipientEmail, $notificationClass);
            $this->successMessage = 'Thank you for contacting us! We have recieved your submission and will respond to you within 24-48 hours';
            $this->resetForm();
        }

        catch(Exception $e){
            $this->errorMessage = 'Something went wrong, please email us directly at '.config('mail.from.address');
            $this->resetForm();

            \Log::error('The followign exception: '.e->getMessage().' was caught in the '.__FUNCTION__ .' method in the '.__CLASS__. ' class');
            \Log::info('Contact submission details: '.$data);
            \Log::info('Submitted on '. date('F jS, Y \a\t g:i A ', strtotime(Carbon::now())));

          
        }
    }


    private function sendNotification(array $data, string $recipientEmail, string $notificationClass): void {

        Notification::route('mail', $recipientEmail)->notify(new $notificationClass($data));
    }

    public function resetForm(): void {

        $this->name = '';
        $this->businessName = '';
        $this->businessEmail = '';
        $this->businessNumber = '';
        $this->subject = '';
        $this->message = '';
    }


    public function render()
    {
        return view('livewire.forms.contact');
    }
}
