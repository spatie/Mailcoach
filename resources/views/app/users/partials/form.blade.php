<x-text-field type="email" label="Email" name="email" :value="$user->email" required />

<x-text-field label="Name" name="name" :value="$user->name" required />

<div class="buttons">
    <button type="submit" class="button">
        Save
    </button>
</div>
