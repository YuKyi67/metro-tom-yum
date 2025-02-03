<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot> --}}

    <x-content>
        <div class="flex justify-end mb-8">
            <a type="button" class="btn btn-primary" href="{{ route('users.create') }}">+ Add New User</a>
        </div>
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
                        <!-- heighlight on hover -->
                        <tr class="hover">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <th>
                                <a type="button" class="btn btn-outline btn-xs"
                                    href="{{ route('profile.edit', $user->id) }}">Manage</a>
                                {{-- <a type="button" class="btn btn-warning btn-xs"
                                    href="{{ route('profile.destroy', $user->id) }}">Delete</a> --}}
                            </th>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </x-content>
</x-app-layout>
