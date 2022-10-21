<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <!-- Styles -->
    @livewireStyles

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="bg-gray-600 shadow-md" x-data="{ isOpen: false }">
        <nav class="container px-6 py-8 mx-auto md:flex md:justify-between md:items-center">
            <div class="flex items-center justify-between">
                <a class="text-xl font-mono text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-rose-400 md:text-2xl hover:text-gray-400"
                    href="/">
                    น้ำดื่ม หยาดทิพย์
                </a>

                <!-- Mobile menu button -->
                <div @click="isOpen = !isOpen" class="flex md:hidden">
                    <button type="button"
                        class="text-gray-800 hover:text-gray-400 focus:outline-none focus:text-gray-400"
                        aria-label="toggle menu">
                        <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                            <path fill-rule="evenodd"
                                d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>


            <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
            <div :class="isOpen ? 'flex' : 'hidden'"
                class="flex-col mt-8 space-y-4 md:flex md:space-y-0 md:flex-row md:items-center md:space-x-10 md:mt-0">
                <a class="text-transparent font-mono bg-clip-text bg-gradient-to-r bg-white hover:text-gray-400"
                    href="/">หน้าแรก</a>


                @if (Auth::check())
                    <a class="text-transparent bg-clip-text bg-gradient-to-r bg-white hover:text-gray-400"
                        href="{{ route('products.checkout') }}">ชำระเงิน</a>


                    <a class="text-transparent bg-clip-text bg-gradient-to-r bg-white hover:text-gray-400"
                        href="{{ route('login') }}">โปรไฟล์</a>

                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <a class="text-transparent bg-clip-text bg-gradient-to-r bg-white hover:text-gray-400"
                            link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            ออกจากระบบ
                        </a>
                    </form>

                    {{-- <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400 hover:text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <a xlink:href="{{ route('products.showcart')}}">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                              </a>
                            </svg>
                            @if (isset($cartItems))
                            <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900"
                            >{{ $cartItems->totalQuantity }}</span>
                            @endif
                        </div>
                 --}}
                @else
                    <a href="{{ route('login') }}"
                        class="text-transparent bg-clip-text bg-gradient-to-r bg-white hover:text-gray-400">เข้าสู่ระบบ</a>
                    <a href="{{ route('register') }}"
                        class="text-transparent bg-clip-text bg-gradient-to-r bg-white hover:text-gray-400">สมัครสมาชิก</a>
                @endif


                {{-- <a class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 hover:text-green-400"
                    href="{{ route('profile.show') }}" :active="request() - > routeIs('profile.show')">
                    {{ __('Profile') }}
                </a> --}}
                {{-- <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div> --}}


                {{-- <div class="pt-2 relative mx-auto text-gray-600">
                    <form action="{{ route('products.search') }}" method="GET">
                    <input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                      type="search" name="search" placeholder="Search">
                    <button type="submit" class="absolute right-0 top-0 mt-5 mr-4">
                      <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                        viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                        width="512px" height="512px">
                        <path
                          d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                      </svg>
                    </button>
                    </form>
                </div> --}}



            </div>
        </nav>
    </div>


    {{-- flash massege --}}
    @if (session()->has('danger'))
        <div class="p-4 mb-4 bg-red-100 border-t border-b border-red-500 text-red-700 px-4 py-3" role="alert">
            <p class="text-sm">{{ session()->get('danger') }}!</p>
        </div>
    @endif
    @if (session()->has('success'))
        <div class="p-4 mb-4 bg-green-100 border-t border-b border-green-500 text-green-700 px-4 py-3" role="alert">
            <p class="text-sm">{{ session()->get('success') }}!</p>
        </div>
    @endif
    @if (session()->has('warning'))
        <div class="p-4 mb-4 bg-yellow-100 border-t border-b border-yellow-500 text-yellow-700 px-4 py-3"
            role="alert">
            <p class="text-sm">{{ session()->get('warning') }}!</p>
        </div>
    @endif


    {{-- slot --}}

    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>

    {{-- footer --}}
    <footer
        class="p-4 bg-gray-600 rounded-lg shadow md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800">
        <span class="text-sm text-white sm:text-center dark:text-gray-400"><a class="hover:underline"></a>
            ติดต่อสอบถามโทร. 086-8545250 , 094-5093224
        </span>
        <ul class="flex flex-wrap items-center mt-3 text-sm text-white dark:text-gray-400 sm:mt-0">
            <li>
                <a href="http://127.0.0.1:8000/products" class="mr-4 hover:underline md:mr-6 ">หน้าแรก</a>
            </li>
            <li>
                <a href="https://www.facebook.com/profile.php?id=100083366259713"
                    class="mr-4 hover:underline md:mr-6">Facebook</a>
            </li>
            <li>

            </li>
            <li>

        </ul>
    </footer>

    @stack('modals')

    @livewireScripts
</body>

</html>
