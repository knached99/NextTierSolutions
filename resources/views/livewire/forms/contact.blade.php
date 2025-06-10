<form wire:submit.prevent="submitContactForm" class="php-email-form">
    <x-honeypot livewire-model="extraFields" />
    <div class="row gy-4">

        <div class="col-md-6">
            <input type="text" wire:model="name"
                class="form-control {{ $errors->has('name') ? 'border border-danger' : '' }}" placeholder="Your Name">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6">
            <input type="text" wire:model="businessName"
                class="form-control {{ $errors->has('businessName') ? 'border border-danger' : '' }}"
                placeholder="Business Name">

            @error('businessName')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 ">
            <input type="email" class="form-control {{ $errors->has('businessEmail') ? 'border border-danger' : '' }}"
                wire:model="businessEmail" placeholder="Email">

            @error('businessEmail')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>

        <div class="col-md-6">
            <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                class="form-control {{ $errors->has('businessNumber') ? 'border border-danger' : '' }}"
                wire:model="businessNumber" placeholder="Number">

            @error('businessNumber')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="col">
            <input type="text" class="form-control {{ $errors->has('subject') ? 'border border-danger' : '' }}"
                wire:model="subject" placeholder="Subject">

            @error('subject')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>

        <div class="col-md-12">
            <textarea class="form-control {{ $errors->has('message') ? 'border border-danger' : '' }}" wire:model="message"
                rows="6" placeholder="Message"></textarea>

            @error('message')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>

        <div class="col-md-12 text-center">
            <div class="loading" wire:loading>Loading</div>

            <button type="submit" wire:loading.remove>Send Message</button>

        </div>


        @if ($errorMessage)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $errorMessage }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif($successMessage)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $successMessage }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    </div>
</form>
