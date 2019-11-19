<li class="dropdown" data-dropdown>
    <button data-dropdown-trigger>
        <img class="w-4 h-4 bg-blue-300 rounded-full">
    </button>
    <ul class="dropdown-list | hidden" data-dropdown-list>
        <li>
            <a href="{{ route('account') }}">
                Account
            </a>
        </li>
        <li>
            <a href="{{ route('users') }}">
                Users
            </a>
        </li>
        <li>
            <form method="post" action="{{ route('logout') }}">
                <button type="submit">Log out</button>
            </form>
        </li>
    </ul>
</li>
