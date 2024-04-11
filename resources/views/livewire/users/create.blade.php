<form class="form-grid" wire:submit="saveUser" method="POST">
    @csrf
    <x-mailcoach::text-field :label="__mc('Name')" name="name" wire:model="name" required />

    <x-mailcoach::text-field type="email" :label="__mc('Email')" wire:model="email" name="email" required />

    <div class="form-buttons">
        <x-mailcoach::button :label="__mc('Create new user')" />

        <button type="button" class="button-link ml-4" x-on:click="$dispatch('close-modal', { id: 'create-user' })">
            {{ __mc('Cancel') }}
        </button>
    </div>
</form>
