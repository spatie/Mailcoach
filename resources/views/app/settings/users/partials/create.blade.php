<form class="form-grid" action="{{ route('users.create') }}" method="POST">
    @csrf
    <x-text-field type="email" label="Email" name="email" required />

    <x-text-field label="Name" name="name" required />

    <div class="form-buttons">
        <button class="button">
            <x-icon-label icon="fa-user" text="Create new user" />
        </button>
        <button type="button" class="button-cancel" data-modal-dismiss>
            Cancel
        </button>
    </div>
</form>