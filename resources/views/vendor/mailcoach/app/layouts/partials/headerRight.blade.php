<div class="dropdown" data-dropdown>
    <button class="dropdown-trigger" data-dropdown-trigger>
        <i class="fas fa-cog | block text-2xl icon-button"></i>
    </button>
    <ul class="dropdown-list dropdown-list-left | hidden" data-dropdown-list>
        <li>
            <a href="{{ route('account') }}">
                <span class="icon-label">
                    <i class="fas fa-fw fa-user"></i> Account
                </span>
            </a>
        </li>
        <li>
            <a href="{{ route('users') }}">
                <span class="icon-label">
                    <i class="fas fa-fw fa-users"></i> Users
                </span>
            </a>
        </li>
        <li>
            <a href="{{ route('mailConfiguration') }}">
                <span class="icon-label whitespace-no-wrap">
                    <i class="fas fa-fw fa-server"></i> Mail configuration
                </span>
            </a>
        </li>
        <li>
            <a href="{{ route('transactionalMailConfiguration') }}">
                <span class="icon-label whitespace-no-wrap">
                    <i class="fas fa-fw fa-server"></i> Transactional Mail configuration
                </span>
            </a>
        </li>
        <li>
            <form method="post" action="{{ route('logout') }}">
                <button type="submit">
                    <span class="icon-label">
                        <i class="fas fa-fw fa-power-off text-red-500"></i>
                        Log out
                    </span>
                </button>
            </form>
        </li>
    </ul>
</div>
