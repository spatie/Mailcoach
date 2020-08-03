@extends('app.settings.account.layouts.account', ['titlePrefix' => __('Tokens')])

@section('breadcrumbs')
    <li>
        <a href="{{ route('account') }}">
            {{ __('Account') }}
        </a>
    </li>
    <li>{{ __('Tokens') }}</li>
@endsection

@section('account')

    <form class="mb-6"
          action="{{ route('tokens.create') }}"
          method="POST"
          data-dirty-check
    >
        @csrf

        <div class="flex items-end">
            <div class="flex-grow max-w-xl">
                <x-text-field
                    :label="__('Token name')"
                    name="name"
                    :placeholder="__('My API token')"

                    :required="true"
                    type="text"
                />
            </div>

            <button type="submit" class="ml-2 button">
                <x-icon-label icon="fa-key" :text="__('Create token')"/>
            </button>
        </div>

        @error('emails')
        <p class="form-error">{{ $message }}</p>
        @enderror
    </form>

    @if (session()->has('newToken'))
        @push('modals')
            <x-modal :open="true" :title="__('Your new token')" name="token">
                <p data-confirm-modal-text class="mb-2">
                    We will display this token only once. Make sure to copy it to a save place.
                </p>


                <pre id="newKey" class="max-w-full whitespace-pre-wrap break-all font-mono bg-gray-100">{{ session()->get('newToken') }}</pre>


                <div class="form-buttons justify-end">
                    <div>
                    <span class="underline text-sm mr-4" onclick="copyToClipboard(this, '{{ session()->get('newToken') }}')">Copy to clipboard</span>
                    <button type="button" class="button" data-modal-dismiss>
                        {{ __('OK') }}
                    </button>
                    </div>
                </div>
            </x-modal>
            <script>
                function copyToClipboard(element, key)
                {
                    const el = document.createElement('textarea');
                    el.value = key;
                    document.body.appendChild(el);
                    el.select();
                    document.execCommand('copy');
                    document.body.removeChild(el);

                    element.innerText = 'Copied!';
                }
            </script>
        @endpush
    @endif

    @if (count($tokens))
        <table class="table mb-6">
            <thead>
            <tr>
                <x-th>{{ __('Name') }}</x-th>
                <x-th>{{ __('Last used at') }}</x-th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($tokens as $token)
                <tr>
                    <td>{{ $token->name }}</td>
                    <td>{{ $token->last_used_at ?? 'Not used yet' }}</td>
                    <td class="td-action">
                        <div class="dropdown" data-dropdown>
                            <button class="icon-button" data-dropdown-trigger>
                                <i class="fas fa-ellipsis-v | dropdown-trigger-rotate"></i>
                            </button>
                            <ul class="dropdown-list dropdown-list-left | hidden" data-dropdown-list>
                                <li>
                                    <x-form-button :action="route('tokens.delete', $token)" method="DELETE"
                                                   data-confirm>
                                        <x-icon-label icon="fa-trash-alt" :text="__('Delete')" :caution="true"/>
                                    </x-form-button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <x-help>
        You can use tokens to authenticate against our the Mailcoach. You'll find more info in <a
            href="https://mailcoach.app/docs">our docs</a>.
    </x-help>
@endsection
