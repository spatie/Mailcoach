<form class="form-grid" wire:submit="saveUser" method="POST">
    @csrf
    <x-mailcoach::text-field :label="__mc('Name')" name="name" wire:model="name" required />

    <x-mailcoach::text-field type="email" :label="__mc('Email')" wire:model="email" name="email" required />

    <x-mailcoach::form-buttons>
        <x-mailcoach::button :label="__mc('Create new user')" />

        <button type="button" class="button-cancel" x-on:click="$store.modals.close('create-user')">
            {{ __mc('Cancel') }}
        </button>
    </x-mailcoach::form-buttons>
</form>
