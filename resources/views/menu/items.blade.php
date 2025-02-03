<x-app-layout>
    <x-content>
        <div class="flex justify-end mb-8">
            <a type="button" class="btn btn-primary" href="{{ route('menu.create') }}">Add New Item</a>
        </div>
        <div class="grid grid-cols-2">
            <div
                class="flex justify-between border border-neutral/50 hover:border-neutral hover:bg-neutral/50 hover:shadow-lg p-4">
                <div class="flex gap-4">
                    <figure class="m-0">
                        <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                            alt="Shoes" class="h-32 w-40 rounded-lg" />
                    </figure>
                    <div>
                        <h4>Name</h4>
                        <p>price</p>
                        <div class="badge badge-primary badge-outline mt-8">category</div>
                    </div>
                </div>
                <div class="flex flex-col gap-4">
                    <a type="btn" href="{{ route('menu.edit') }}" class="btn btn-outline btn-sm">Edit</a>
                    <a
                        type="btn"
                        class="btn btn-warning btn-sm"
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-item-deletioin')"
                    >Delete</a>

                    <x-modal name="confirm-item-deletioin" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('menu.destroy') }}" class="p-6">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Are you sure?') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 ">
                                {{ __('Once this item is deleted, all of its resources and data will be permanently deleted.') }}
                            </p>

                            <div class="mt-6 flex justify-start">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-danger-button class="ms-3">
                                    {{ __('Delete') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>
                </div>
            </div>
        </div>
    </x-content>
</x-app-layout>
