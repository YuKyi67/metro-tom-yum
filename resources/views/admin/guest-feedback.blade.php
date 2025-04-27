<x-app-layout>

    <x-content>
        {{-- <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($feedbacks as $msg)
                        <!-- heighlight on hover -->
                        <tr class="hover">
                            <td>{{ $msg->name }}</td>
                            <td>{{ $msg->email }}</td>
                            <td>{{ $msg->subject }}</td>
                            <td>{{ $msg->message }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div> --}}

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($feedbacks as $msg)
            <div class="card bg-neutral shadow-sm">
                <div class="card-body space-y-8">
                    <div class="text-center">
                        <h2 class="text-center text-sm text-primary underline">{{$msg->subject}}</h2>
                        <p>{{$msg->message}}</p>
                    </div>

                    <div class="text-end">
                        <p class="text-xs text-gray-500">{{$msg->name}}</p>
                        <p class="text-gray-400 text-sm">{{$msg->email}}</p>
                    </div>
                </div>
                
            </div>
            @endforeach
        </div>

        <div class="mt-4">
        {{ $feedbacks->links() }}
        </div>
    </x-content>
</x-app-layout>