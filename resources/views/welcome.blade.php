<x-guest-layout>
    <img 
        class="w-full h-[750px]"
        src="{{ Vite::asset('resources/images/tomyum-temp-photo.jpg') }}"
        alt="" 
        srcset=""
    >

    <div class="container mx-auto px-4">
        <div class="prose prose-headings:text-primary pb-8">
            <h1>Today's special</h1>
            {{-- <hr class="bg-primary" /> --}}
        </div>
        
        <div class="grid md:grid-cols-4 gap-8">
            <x-card>
                <h2 class="card-title">Shoes!</h2>
                <p>If a dog chews shoes whose shoes does he choose?</p>
                <button class="btn btn-primary">Order Now</button>
            </x-card>
            <x-card>
                <h2 class="card-title">Shoes!</h2>
                <p>If a dog chews shoes whose shoes does he choose?</p>
                <button class="btn btn-primary">Order Now</button>
            </x-card>
            <x-card>
                <h2 class="card-title">Shoes!</h2>
                <p>If a dog chews shoes whose shoes does he choose?</p>
                <button class="btn btn-primary">Order Now</button>
            </x-card>
            <x-card>
                <h2 class="card-title">Shoes!</h2>
                <p>If a dog chews shoes whose shoes does he choose?</p>
                <button class="btn btn-primary">Order Now</button>
            </x-card>
        </div>
    </div>
</x-guest-layout>
