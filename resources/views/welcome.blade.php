<x-guest-layout>
    <img class="w-full h-[750px]" src="{{ Vite::asset('resources/images/tomyum-temp-photo.jpg') }}" alt=""
        srcset="">

    <div class="container max-w-7xl mx-auto px-4">
        <div class="prose prose-headings:text-primary prose-a:no-underline pb-8">
            <h1>What We Offer</h1>
            {{--
            <hr class="bg-primary" /> --}}
            {{-- <div role="tablist" class="tabs tabs-bordered">
                <a role="tab" class="tab">Tomyam Soup</a>
                <a role="tab" class="tab tab-active">Noodles</a>
                <a role="tab" class="tab">Rice Dishes</a>
                <a role="tab" class="tab">Side Dishes</a>
                <a role="tab" class="tab">Drinks</a>
            </div> --}}
        </div>

        @include('menu.partials.menu-item-list')
    </div>
</x-guest-layout>
