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
                wire:model="businessEmail" placeholder="Business Email">

            @error('businessEmail')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>

        <div class="col-md-6">
            <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                class="form-control {{ $errors->has('businessNumber') ? 'border border-danger' : '' }}"
                wire:model="businessNumber" placeholder="Business Number">

            @error('businessNumber')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6">
            <input type="text" class="form-control {{ $errors->has('userRole') ? 'border border-danger' : '' }}"
                wire:model="userRole" placeholder="Your Role">

            @error('userRole')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>

        <div class="col-md-6" class="col-md-12">
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

            @if ($errorMessage)
                <div class="error-message">
                    {{ $errorMessage }}

                </div>
            @elseif($successMessage)
                <div class="sent-message">

                    {{ $successMessage }}

                </div>
            @endif

            <button type="submit" wire:loading.remove>Send Message</button>
        </div>

    </div>
</form>
