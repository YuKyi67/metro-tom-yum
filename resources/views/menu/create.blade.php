<x-app-layout>
    <x-content>
        <form method="POST" action="">
            @csrf
            <div class="prose space-y-6 sm:px-6 lg:px-8 sm:max-w-lg mx-auto px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                <h1>Add New Item</h1>
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="price" :value="__('Price')" />
                    <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')"
                        required />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="category" :value="__('Category')" />
                    <x-text-input id="category" class="block mt-1 w-full" type="text" name="category" :value="old('category')"
                        required autofocus autocomplete="category" />
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="imagePath" :value="__('Upload product image')" />
                    <input type="file" id="imagePath" class="file-input file-input-md file-input-bordered w-full" />
                </div>

                <x-primary-button>
                    Submit
                </x-primary-button>
            </div>
        </form>
    </x-content>
</x-app-layout>
