<form action="{{ action(\App\Http\App\Controllers\Settings\Users\CreateUserController::class) }}" method="POST">
    @csrf
    <x-text-field type="email" label="Email" name="email" required />

    <x-text-field label="Name" name="name" required />

    <div class="buttons">
        <button type="button" class="button-secondary" data-modal-dismiss>
            Cancel
        </button>
        <button class="button">
            Create
        </button>
    </div>
</form>

