<x-guest-layout>
    <!-- 🔹 Slideshow Container -->
    <div class="relative w-full h-[550px] overflow-hidden">
        <div class="absolute w-full h-full">
            
        <!-- Slides with Text -->
        <!-- Slide 1: Air Kelapa -->
        <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000 flex items-center justify-center">
            <img src="{{ Vite::asset('resources/images/Drinks/Air Kelapa.jpg') }}" class="w-full h-full object-fit:contain">
            <div class="absolute text-center">
                <h1 class="text-6xl italic font-semibold font-serif" style="color: #87CEEB;">Refreshing Air Kelapa</h1>
                <p class="text-2xl font-bold" style="font-family: 'Times New Roman', serif; color:rgb(254, 131, 0);">Taste the freshness!</p>
            </div>
        </div>

        <!-- Slide 2: Kuet Teow Goreng Tomyam -->
        <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000 flex items-center justify-center">
            <img src="{{ Vite::asset('resources/images/Noodles/Goreng/Kuet Teow Goreng Tomyam.jpg') }}" class="w-full h-full object-fit:contain">
            <div class="absolute text-center">
                <h1 class="text-6xl italic font-semibold font-serif" style="color: #87CEEB;">Spicy Kuet Teow Goreng</h1>
                <p class="text-2xl font-bold" style="font-family: 'Times New Roman', serif; color:rgb(251, 0, 0);">Hot & delicious!</p>   
            </div>
        </div>

        <!-- Slide 3: Nasi Goreng Tomyam -->
        <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000 flex items-center justify-center">
            <img src="{{ Vite::asset('resources/images/Rice Dishes/Nasi Goreng Tomyam.jpg') }}" class="w-full h-full object-fit:contain">
            <div class="absolute text-center">
                <h1 class="text-6xl italic font-semibold font-serif" style="color: #87CEEB;">Nasi Goreng Tomyam</h1>
                <p class="text-2xl font-bold" style="font-family: 'Times New Roman', serif; color:rgb(143, 255, 78);">Full of flavors!</p>
            </div>
        </div>

        <!-- Slide 4: Kerabu Mangga -->
        <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000 flex items-center justify-center">
            <img src="{{ Vite::asset('resources/images/Side Dishes/Kerabu Mangga.jpg') }}" class="w-full h-full ">
            <div class="absolute text-center">
                <h1 class="text-6xl italic font-semibold font-serif" style="color: #87CEEB;">Kerabu Mangga</h1>
                <p class="text-2xl font-bold" style="font-family: 'Times New Roman', serif; color:rgb(93, 229, 220);">A refreshing side dish!</p>
            </div>
        </div>


            <script>
                function triggerAnimation() {
                    let text = document.getElementById("animatedText");
                    
                    if (text) {
                        text.classList.remove("opacity-0", "translate-y-10");
                        text.classList.add("opacity-100", "translate-y-0");
            
                        // Delay redirection after animation
                        setTimeout(() => {
                            window.location.href = "/order"; // Redirect to Order Page
                        }, 1000); // 1-second delay before redirect
                    } else {
                        console.error("Element with ID 'animatedText' not found.");
                    }
                }
            </script>
            
        </div>

        <!-- Left & Right Arrow Buttons -->
        <button id="prevBtn" class="arrow-btn left-5">❮</button>
        <button id="nextBtn" class="arrow-btn right-5">❯</button>

        <!-- Dots Indicator -->
        <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex space-x-2">
            <span class="dot w-3 h-3 bg-gray-400 rounded-full cursor-pointer" data-index="0"></span>
            <span class="dot w-3 h-3 bg-gray-400 rounded-full cursor-pointer" data-index="1"></span>
            <span class="dot w-3 h-3 bg-gray-400 rounded-full cursor-pointer" data-index="2"></span>
            <span class="dot w-3 h-3 bg-gray-400 rounded-full cursor-pointer" data-index="3"></span>
        </div>
    </div>

        <!-- Menu -->
        <div class="container max-w-7xl mx-auto px-4 mt-10">
        <div class="w-full flex justify-left items-left">
        <div class="flex items-center">
            <img src="{{ asset('images/Icon/menu.gif') }}" alt="Gif" class="w-12 h-12 mr-2">
            <h1 class="text-3xl italic font-semibold font-serif">Menu</h1>
        </div>
    </div>                     
            @include('menu.partials.menu-item-list')
    </div>
    <!-- JavaScript for Slideshow -->
    <script>
        let slides = document.querySelectorAll('.slide');
        let dots = document.querySelectorAll('.dot');
        let index = 0;
        let interval = setInterval(showNextSlide, 3000);
  
        function updateSlide(newIndex) {
            slides.forEach(slide => slide.classList.remove('opacity-100'));
            dots.forEach(dot => dot.classList.remove('bg-white'));
  
            index = newIndex;
            slides[index].classList.add('opacity-100');
            dots[index].classList.add('bg-white');
  
            // Random animation effects
            let animations = ["animate__fadeInDown", "animate__zoomIn", "animate__fadeInLeft", "animate__bounceIn"];
            let randomEffect = animations[Math.floor(Math.random() * animations.length)];
  
            let textElements = slides[index].querySelectorAll('.animate__animated');
            textElements.forEach(el => {
                el.classList.remove(...animations, 'animate__delay-1s');
                void el.offsetWidth; // **Force reflow**
                el.classList.add(randomEffect, 'animate__delay-1s');
            });
        }
  
        function showNextSlide() {
            updateSlide((index + 1) % slides.length);
        }
  
        function showPrevSlide() {
            updateSlide((index - 1 + slides.length) % slides.length);
        }
  
        // Click events for arrows
        document.getElementById('nextBtn').addEventListener('click', () => {
            clearInterval(interval);
            showNextSlide();
            interval = setInterval(showNextSlide, 3000);
        });
  
        document.getElementById('prevBtn').addEventListener('click', () => {
            clearInterval(interval);
            showPrevSlide();
            interval = setInterval(showNextSlide, 3000);
        });
  
        // Click events for dots
        dots.forEach(dot => {
            dot.addEventListener('click', (e) => {
                clearInterval(interval);
                updateSlide(parseInt(e.target.dataset.index));
                interval = setInterval(showNextSlide, 3000);
            });
        });
  
        // Start slideshow
        showNextSlide();
    </script>
  
    <!-- Styles -->
    <style>
        .slide {
            opacity: 0;
            transition: opacity 1s ease-in-out;
            position: absolute;
            inset: 0;
        }
        .opacity-100 {
            opacity: 1 !important;
        }
        .dot {
            transition: background 0.3s;
        }
        .bg-white {
            background-color: white !important;
        }
        .absolute.text-white {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
        }
  
        /* Arrow Button Fix */
        .arrow-btn {
            width: 50px;
            height: 50px;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }
  
        /* Hover Effect */
        .arrow-btn:hover {
            background-color: #F46E05;
        }
        .menu-btn:hover {
            background-color:rgb(0, 0, 0);
            text : text-white;
        }
        /* Correct Position */
        .left-5 {
            left: 20px;
        }
  
        .right-5 {
            right: 20px;
        }
    </style>


@if (session('show_popup'))
    <div id="popupAlert"
        class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-yellow-100 border border-yellow-500 rounded-lg shadow-lg px-8 py-6 text-center relative">
            <img src="{{ asset('images/Icon/yay.gif') }}" alt="Gif" style="width:100px; height:100px;"
                class="mx-auto mb-4">
            <p class="text-lg font-semibold text-yellow-900">Welcome You~</p>
        </div>
    </div>

    <script>
        setTimeout(() => {
            document.getElementById('popupAlert').style.display = 'none';
        }, 3000);
    </script>

    @php session()->forget('show_popup') @endphp
@endif

</x-guest-layout>
