<form
    class="card-grid"
    action="{{ route('mailConfiguration') }}"
    method="POST"
>
    @csrf
    @method('PUT')

    <input type="hidden" name="driver" name="smtp" />
    <x-text-field label="Mail host" name="host" type="text" :value="$mailConfiguration->host"/>
    <x-text-field label="Mail port" name="port" type="text" :value="$mailConfiguration->port"/>
    <x-text-field label="Mail username" name="username" type="text"
                  :value="$mailConfiguration->username"/>
    <x-text-field label="Mail password" name="password" type="password"
                  :value="$mailConfiguration->password"/>

    <button type="submit" class="button">
        Save
    </button>
</form>
