<div class="dropdown" data-dropdown>
    <button data-dropdown-trigger>
        <i class="fas fa-user-circle | block text-2xl opacity-50 | hover:opacity-75"></i>
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
</div>
