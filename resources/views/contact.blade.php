<x-guest-layout>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 md:gap-8 max-w-screen-xl mx-auto p-4 pt-40">
        <div class="col-span-1 md:col-span-2 sm:pr-12 sm:border-r dark:border-secondary/50">
            <!-- Success Message -->
@if(session('success'))
        <div id="toast-message" class="toast toast-bottom toast-end">
            <div class="alert flex items-center space-x-3 p-4 rounded-lg shadow-lg" style="background-color: #D0FFC7;">
            <!-- GIF Icon -->
            <img src="{{ asset('images/Icon/thanks.gif') }}" alt="Gif" class="w-12 h-12">

            <!-- Message -->
            <span class="text-black font-medium">
                Thank you for your feedback.<br>
                Message sent successfully.
            </span>
            </div>
        </div>

            <!-- Auto-hide after 3 seconds -->
            <script>
                    setTimeout(function() {
                    document.getElementById('toast-message').style.display = 'none';
                    }, 3000); // 3 seconds
            </script>
@endif
            <form action="{{ route('contact.store') }}" method="post">
                @csrf

                <div class="space-y-8">
                    <div class="prose prose-headings:text-primary">
                        <span class="inline-flex items-center space-x-3">
                            <img src="{{ asset('images/Icon/feedback.gif') }}" alt="Gif" class="w-10 h-10 mt-[2px]">
                            <h1>Your feedbacks are always welcome</h1>
                        </span>                        
                    </div>

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                            required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Subject -->
                    <div>
                        <x-input-label for="subject" :value="__('Subject')" />
                        <x-text-input id="subject" class="block mt-1 w-full" type="text" name="subject"
                            :value="old('subject')" required autofocus autocomplete="subject" />
                        <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                    </div>

                    <!-- Message -->
                    <div>
                        <x-input-label for="message" :value="__('Message')" />
                        <textarea
                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            id="message" name="message" rows="8" required></textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    </div>

                    <x-primary-button class="px-12">
                        {{ __('Send') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        {{-- used tailwind typography --}}
        <div class="prose prose-headings:text-primary">
            <p class="font-serif font-semibold italic drop-shadow-md">Get in touch with</p>            
            <h1 style="font-family: 'Times New Roman', Times, serif; font-size: 48px;">Metro</h1>
            <div class="flex items-center gap-4">
                <svg class="h-14 stroke-current text-primary" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M12 6H12.01M9 20L3 17V4L5 5M9 20L15 17M9 20V14M15 17L21 20V7L19 6M15 17V14M15 6.2C15 7.96731 13.5 9.4 12 11C10.5 9.4 9 7.96731 9 6.2C9 4.43269 10.3431 3 12 3C13.6569 3 15 4.43269 15 6.2Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                    </g>
                </svg>
                <p>No 9, MEDAN SELERA LAMA, TAMAN MELAWATI, 53100 KUALA LUMPUR, SELENGOR</p>
            </div>
            <div class="flex items-center gap-4">
                <svg class="h-9 stroke-current text-primary" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                </svg>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.5582081844796!2d101.74992167454995!3d3.210028796765155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc39b554f12ea3%3A0xa0ee4d4c874d7df7!2sMetro%20Tomyam!5e0!3m2!1sen!2smy!4v1740368363711!5m2!1sen!2smy" 
                ></iframe>
            </div>

            <div class="flex items-center gap-4">
                <svg class="h-9 stroke-current text-primary" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M21.97 18.33C21.97 18.69 21.89 19.06 21.72 19.42C21.55 19.78 21.33 20.12 21.04 20.44C20.55 20.98 20.01 21.37 19.4 21.62C18.8 21.87 18.15 22 17.45 22C16.43 22 15.34 21.76 14.19 21.27C13.04 20.78 11.89 20.12 10.75 19.29C9.6 18.45 8.51 17.52 7.47 16.49C6.44 15.45 5.51 14.36 4.68 13.22C3.86 12.08 3.2 10.94 2.72 9.81C2.24 8.67 2 7.58 2 6.54C2 5.86 2.12 5.21 2.36 4.61C2.6 4 2.98 3.44 3.51 2.94C4.15 2.31 4.85 2 5.59 2C5.87 2 6.15 2.06 6.4 2.18C6.66 2.3 6.89 2.48 7.07 2.74L9.39 6.01C9.57 6.26 9.7 6.49 9.79 6.71C9.88 6.92 9.93 7.13 9.93 7.32C9.93 7.56 9.86 7.8 9.72 8.03C9.59 8.26 9.4 8.5 9.16 8.74L8.4 9.53C8.29 9.64 8.24 9.77 8.24 9.93C8.24 10.01 8.25 10.08 8.27 10.16C8.3 10.24 8.33 10.3 8.35 10.36C8.53 10.69 8.84 11.12 9.28 11.64C9.73 12.16 10.21 12.69 10.73 13.22C11.27 13.75 11.79 14.24 12.32 14.69C12.84 15.13 13.27 15.43 13.61 15.61C13.66 15.63 13.72 15.66 13.79 15.69C13.87 15.72 13.95 15.73 14.04 15.73C14.21 15.73 14.34 15.67 14.45 15.56L15.21 14.81C15.46 14.56 15.7 14.37 15.93 14.25C16.16 14.11 16.39 14.04 16.64 14.04C16.83 14.04 17.03 14.08 17.25 14.17C17.47 14.26 17.7 14.39 17.95 14.56L21.26 16.91C21.52 17.09 21.7 17.3 21.81 17.55C21.91 17.8 21.97 18.05 21.97 18.33Z"
                            stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"></path>
                        <path opacity="0.4" d="M18.5 9C18.5 8.4 18.03 7.48 17.33 6.73C16.69 6.04 15.84 5.5 15 5.5"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                        <path opacity="0.4" d="M22 9C22 5.13 18.87 2 15 2" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
                <p>+60 17 6144 686</p>
            </div>

            <div class="flex items-center gap-4">
                <svg class="h-9 stroke-current text-primary" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M11.9426 1.25H12.0574C14.3658 1.24999 16.1748 1.24998 17.5863 1.43975C19.031 1.63399 20.1711 2.03933 21.0659 2.93414C21.9607 3.82895 22.366 4.96897 22.5603 6.41371C22.75 7.82519 22.75 9.63423 22.75 11.9426V12.0574C22.75 14.3658 22.75 16.1748 22.5603 17.5863C22.366 19.031 21.9607 20.1711 21.0659 21.0659C20.1711 21.9607 19.031 22.366 17.5863 22.5603C16.1748 22.75 14.3658 22.75 12.0574 22.75H11.9426C9.63423 22.75 7.82519 22.75 6.41371 22.5603C4.96897 22.366 3.82895 21.9607 2.93414 21.0659C2.03933 20.1711 1.63399 19.031 1.43975 17.5863C1.24998 16.1748 1.24999 14.3658 1.25 12.0574V11.9426C1.24999 9.63423 1.24998 7.82519 1.43975 6.41371C1.63399 4.96897 2.03933 3.82895 2.93414 2.93414C3.82895 2.03933 4.96897 1.63399 6.41371 1.43975C7.82519 1.24998 9.63423 1.24999 11.9426 1.25ZM6.61358 2.92637C5.33517 3.09825 4.56445 3.42514 3.9948 3.9948C3.42514 4.56445 3.09825 5.33517 2.92637 6.61358C2.75159 7.91356 2.75 9.62177 2.75 12C2.75 14.3782 2.75159 16.0864 2.92637 17.3864C3.09825 18.6648 3.42514 19.4355 3.9948 20.0052C4.56445 20.5749 5.33517 20.9018 6.61358 21.0736C7.91356 21.2484 9.62177 21.25 12 21.25C14.3782 21.25 16.0864 21.2484 17.3864 21.0736C18.6648 20.9018 19.4355 20.5749 20.0052 20.0052C20.5749 19.4355 20.9018 18.6648 21.0736 17.3864C21.2484 16.0864 21.25 14.3782 21.25 12C21.25 9.62177 21.2484 7.91356 21.0736 6.61358C20.9018 5.33517 20.5749 4.56445 20.0052 3.9948C19.4355 3.42514 18.6648 3.09825 17.3864 2.92637C16.0864 2.75159 14.3782 2.75 12 2.75C9.62177 2.75 7.91356 2.75159 6.61358 2.92637ZM12 7.25C12.4142 7.25 12.75 7.58579 12.75 8V11.6893L15.0303 13.9697C15.3232 14.2626 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2626 15.3232 13.9697 15.0303L11.8358 12.8964C11.5468 12.6074 11.4022 12.4629 11.3261 12.2791C11.25 12.0954 11.25 11.891 11.25 11.4822V8C11.25 7.58579 11.5858 7.25 12 7.25Z"
                            stroke="currentColor" fill="none"></path>
                    </g>
                </svg>
                <p class="flex items-center gap-4">
                    MONDAY TO FRIDAY
                    <strong class="text-lg">8:30 AM to 5:00 PM</strong>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>