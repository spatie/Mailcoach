<div>
    <x-help>
        {!! __('<a href=":link">Unlayer</a> is a beautiful editor that allows you to edit html in a structured way. You don\'t need any HTML knowledge to compose a campaign or template. This editor also allows image uploads.', ['link' => 'https://unlayer.com']) !!}
        <br>
        {{ __('Mailcoach uses the free version of Unlayer.') }}
    </x-help>

    <div class="alert alert-warning max-w-xl text-sm">
        {{ __('Unlayer editor stores content in a structured way. When switching from or to Unlayer, content in existing templates and draft campaigns will get lost.') }}
    </div>
</div>
