<form
    class="card-grid"
    action="{{ route('mailConfiguration') }}"
    method="POST"
>
    @csrf
    @method('PUT')

    <input type="hidden" name="driver" value="smtp" />
    <x-text-field label="Host" name="host" type="text" :value="$mailConfiguration->host"/>
    <x-text-field label="Port" name="port" type="text" :value="$mailConfiguration->port"/>
    <x-text-field label="Username" name="username" type="text"
                  :value="$mailConfiguration->username"/>
    <x-text-field label="Password" name="password" type="password"
                  :value="$mailConfiguration->password"/>

    <button type="submit" class="button">
        Save
    </button>
</form>
