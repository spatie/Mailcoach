<x-navigation-item :href="route('account')">
    Account
</x-navigation-item>

<x-navigation-item :href="route('users')">
    Users
</x-navigation-item>


<li>
    <form method="post" action="{{ route('logout') }}">
        <button type="submit">Log out</button>
    </form>
</li>
