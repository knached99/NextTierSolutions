<div class="editable" contenteditable="true" wire:ignore x-data x-init="const el = $el;
let timeout;

const updateLivewire = () => {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        @this.set('content', el.innerHTML);
    }, 1000); // debounce save
};

el.addEventListener('input', updateLivewire);" x-html="`{{ $content }}`">
</div>
