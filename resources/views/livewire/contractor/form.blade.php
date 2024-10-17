<div class="space-y-6">
    
    <div>
        <x-input-label for="name" :value="__('Name')"/>
        <x-text-input wire:model="form.name" id="name" name="name" type="text" class="mt-1 block w-full" autocomplete="name" placeholder="Name"/>
        @error('form.name')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="prefix_name" :value="__('Prefix Name')"/>
        <x-text-input wire:model="form.prefix_name" id="prefix_name" name="prefix_name" type="text" class="mt-1 block w-full" autocomplete="prefix_name" placeholder="Prefix Name"/>
        @error('form.prefix_name')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="suffix_name" :value="__('Suffix Name')"/>
        <x-text-input wire:model="form.suffix_name" id="suffix_name" name="suffix_name" type="text" class="mt-1 block w-full" autocomplete="suffix_name" placeholder="Suffix Name"/>
        @error('form.suffix_name')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>