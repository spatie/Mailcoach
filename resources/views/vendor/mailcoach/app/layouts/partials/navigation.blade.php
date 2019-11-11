<header class="py-6 text-gray-700">
    <nav class="layout-col flex justify-between items-center">
        @include('mailcoach::app.layouts.partials.logo')

        <ul class="grid cols-auto justify-end gap-6 leading-none">
            <x-navigation-item :href="route('mailcoach.campaigns')">
                Campaigns
            </x-navigation-item>
            <x-navigation-item :href="route('mailcoach.templates')">
                Templates
            </x-navigation-item>
            <x-navigation-item :href="route('mailcoach.lists')">
                Lists
            </x-navigation-item>
            <x-navigation-item :href="route('mailcoach.subscribers')">
                Subscribers
            </x-navigation-item>
            <x-navigation-item :href="route('mailcoach-app.users')">
                Users
            </x-navigation-item>
        </ul>
    </nav>
</header>
