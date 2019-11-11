@extends('mailcoach::app.layouts.app', ['title' => 'Users'])

@section('content')
    <main class="layout-main">
        <section class="card card-grid">
            <h1 class="markup-h1">Templates</h1>

            <div class="flex justify-between">
                <a href="{{ action([\App\Http\App\Controllers\Settings\Users\CreateUserController::class, 'create']) }}" class="button">
                    Create new user
                </a>

                <input
                    type="text"
                    class="form-input w-64 rounded-full"
                    placeholder="Filter users…"
                >
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th>Email</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr
                        class="tr-clickable"
                        data-href="{{ action([\App\Http\App\Controllers\Settings\Users\UpdateUserController::class, 'edit'], $user) }}"
                    >
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <p class="table-status">
                @if($users->hasMorePages())
                    Displaying {{ $users->count() }} of {{ $totalUsersCount }}
                    {{ Illuminate\Support\Str::plural('template', $totalUsersCount) }}.
                    <a
                        href="{{ route('mailcoach-app.users') }}"
                        class="link"
                    >
                        Show all
                    </a>
                @else
                    Displaying all {{ $totalUsersCount }}
                    {{ Illuminate\Support\Str::plural('user', $totalUsersCount) }}.
                @endif
            </p>

            {{ $users->links() }}
        </section>
    </main>
@endsection
