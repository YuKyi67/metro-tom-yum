<?php

?>

<x-guest-layout>
    <img 
        class="w-full h-[750px]"
        src="{{ Vite::asset('resources/images/tomyum-temp-photo.jpg') }}"
        alt="" 
        srcset=""
    >

    <div class="max-w-screen-xl mx-auto px-2 sm:px-4 prose">
        {{-- <hr class="text-primary bg-primary" /> --}}
        <h1 class="text-primary m-0">Today's special</h1>
        <hr class="bg-primary" />

        <div class="grid md:grid-cols-3 gap-8">
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
