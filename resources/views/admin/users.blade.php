<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <x-content>
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
                                <button class="btn btn-ghost btn-xs">Edit</button>
                                <button class="btn btn-warning btn-xs">Delete</button>
                            </th>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </x-content>
</x-app-layout>