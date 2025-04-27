<x-app-layout>
    <x-content>

        <!-- Show "Add New User" Button Only to Admins -->
        @if(Auth::user() && Auth::user()->role === 'admin')
            <div class="flex justify-end mb-8">
                <a type="button" class="btn btn-primary" href="{{ route('users.create') }}">+ Add New User</a>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <th>
                                <a type="button" class="btn btn-outline btn-xs"
                                    href="{{ route('profile.edit', $user->id) }}">Manage</a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </x-content>
</x-app-layout>
