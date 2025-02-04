<x-app-layout>
    <x-content>
        <form method="POST" action="{{ route('menu.store') }}" enctype="multipart/form-data">
            @csrf
            <div
                class="prose space-y-6 sm:px-6 lg:px-8 sm:max-w-lg mx-auto px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                <h1>Add New Item</h1>
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="price" :value="__('Price')" />
                    <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" step="0.01"
                        :value="old('price')" required />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="category" :value="__('Category')" />
                    <select class="select select-bordered w-full" id="category" name="category">
                        <option disabled selected>Categories</option>
                        <option value="Tomyam">Tomyam</option>
                        <option value="Noodle">Noodle</option>
                        <option value="Rice Dish">Rice Dish</option>
                        <option value="Side Dish">Side Dish</option>
                        <option value="Drink">Drink</option>
                    </select>
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="imagePath" :value="__('Upload image')" />
                    <input type="file" id="imagePath" name="imagePath"
                        class="file-input file-input-md file-input-bordered w-full" />
                    <x-input-error :messages="$errors->get('imagePath')" class="mt-2" />
                </div>

                <x-primary-button>
                    Submit
                </x-primary-button>
            </div>
        </form>
    </x-content>
</x-app-layout>
