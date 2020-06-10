<form class="form-grid" action="{{ route('users.create') }}" method="POST">
    @csrf
    <x-text-field type="email" :label="__('Email')" name="email" required />

    <x-text-field :label="__('Name')" name="name" required />

    <div class="form-buttons">
        <button class="button">
            <x-icon-label icon="fa-user" :text="__('Create new user')" />
        </button>
        <button type="button" class="button-cancel" data-modal-dismiss>
            {{ __('Cancel') }}
        </button>
    </div>
</form>
