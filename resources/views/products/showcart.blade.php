<x-guest-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <nav class="bg-gray-200 shadow-md dark:bg-gray-700">
        <div class="py-3 px-4 md:px-6">
            <div class="flex justify-end">
                <ul class="mt-1 mr-2 flex flex-row space-x-1 text-sm font-medium">
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-green-500 hover:text-green-700"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <a xlink:href="{{ route('products.showcart') }}">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </a>
                        </svg>
                        @if (isset($cartItems))
                            <span
                                class="mr-2 h-6 rounded bg-red-500 px-2.5 py-0.5 text-xs font-semibold text-white">{{ $cartItems->totalQuantity }}</span>
                        @endif
                    </div>
                    <div class="relative mx-auto pt-2 text-gray-600">
                        <form action="{{ route('products.search') }}" method="GET">
                            <input
                                class="h-10 rounded-lg border-2 border-gray-300 bg-white px-5 pr-16 text-sm focus:outline-none"
                                type="search" name="search" placeholder="Search" />
                            <button type="submit" class="absolute right-0 top-0 mt-5 mr-4">
                                <svg class="h-4 w-4 fill-current text-gray-600" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
                                    x="0px" y="0px" viewBox="0 0 56.966 56.966"
                                    style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px"
                                    height="512px">
                                    <path
                                        d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                                </svg>

                            </button>
                        </form>
                    </div>
                </ul>
            </div>
        </div>
    </nav>

    <div class = "bg-gradient-to-r from-sky-300 to-blue-600 w-full h-full">
    <div class="py-24">
        <div class="container w-full px-5 py-6 mx-auto">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <h2 class="text-xl font-semibold">Your cart</h2>

                <ul class="flex flex-col divide-y divide-gray-700">


                    @foreach ($cartItems->items as $item)
                        <li class="flex flex-col py-6 sm:flex-row sm:justify-between">
                            <div class="flex w-full space-x-2 sm:space-x-4">
                                <div
                                    class="flex flex-col justify-start items-start dark:bg-gray-800 bg-sky-100 px-4 py-4 md:py-6 md:p-6 xl:p-8 w-full">



                                    <a href="{{ route('products.details', $item['data']['id']) }}">
                                        <img class="h-20 w-20 flex-shrink-0 rounded object-cover outline-none dark:border-transparent dark:bg-gray-500 sm:h-32 sm:w-32"
                                            src="{{ asset($item['data']['image']) }}" alt="" /></a>
                                    <div class="flex w-full flex-col justify-between pb-4">
                                        <div class="flex w-full justify-between space-x-2 pb-2">
                                            <div class="space-y-1">
                                                <a href="{{ route('products.details', $item['data']['id']) }}"
                                                    class="text-lg font-semibold leading-snug sm:pr-8">{{ $item['data']['name'] }}</a>
                                                <p class="text-sm dark:text-gray-400">
                                                    {{ Str::limit($item['data']['description'], 50) }}</p>
                                            </div>
                                            <div class="text-right">
                                                <div class="flex justify-between space-x-8 items-start w-full">
                                                    <p class="text-sm dark:text-gray-600">{{ $item['data']['price'] }}
                                                        บาท</p>
                                                    <div class="flex justify-between space-x-8 items-start w-full">
                                                        <p class="text-lg font-semibold">{{ $item['totalSinglePrice'] }}
                                                            บาท</p>
                                                        {{-- <p class="text-sm line-through dark:text-gray-600">75.50€</p> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex divide-x text-sm">
                                            <a href="{{ route('products.deletefromcart', $item['data']['id']) }}"
                                                type="button" class="flex items-center space-x-1 px-2 py-1 pl-0"
                                                onclick="return confirm('ต้องการลบหรือไม่?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                    class="h-4 w-4 fill-current">
                                                    <path
                                                        d="M96,472a23.82,23.82,0,0,0,23.579,24H392.421A23.82,23.82,0,0,0,416,472V152H96Zm32-288H384V464H128Z">
                                                    </path>
                                                    <rect width="32" height="200" x="168" y="216">
                                                    </rect>
                                                    <rect width="32" height="200" x="240" y="216">
                                                    </rect>
                                                    <rect width="32" height="200" x="312" y="216">
                                                    </rect>
                                                    <path
                                                        d="M328,88V40c0-13.458-9.488-24-21.6-24H205.6C193.488,16,184,26.542,184,40V88H64v32H448V88ZM216,48h80V88H216Z">
                                                    </path>
                                                </svg>
                                                {{-- <a href="{{ route('products.deletefromcart', $item['data']['id']) }}">
                                        <span>Remove</span></a> --}}
                                                <span>Remove</span>
                                            </a>



                                            <div class="flex items-center space-x-1 px-2 py-1">
                                                <span class="mr-3">quality</span>
                                                <a class="m-auto text-3xl font-normal px-2"
                                                    href="{{ route('products.decrementcart', $item['data']['id']) }}">-</a>
                                                <div class="relative">
                                                    <div class="sm:col-span-6">

                                                        <div class="mt-1">
                                                            <input type="text" id="price" name="price"
                                                                value="{{ $item['quantity'] }}"
                                                                class="block w-14 appearance-none rounded-md border border-gray-400 bg-white py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-indigo-500 focus:ring-indigo-500" />
                                                        </div>
                                                    </div>

                                                </div>
                                                <a class="m-auto text-2xl font-normal px-2"
                                                    href="{{ route('products.incrementcart', $item['data']['id']) }}">+</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach


                </ul>

                <div class="space-y-1 text-right text-white">
                    <p><strong>จำนวนสินค้า : </strong>{{ $cartItems->totalQuantity }}</p>
                    <p><strong>ราคารวม : </strong>{{ $cartItems->totalPrice }} บาท</p>

                </div>
                <br>
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('products.index') }}"
                        class="mr-5 rounded-sm bg-gray-400 hover:bg-gray-700 px-3 py-1 text-white shadow-md">
                        <button class="">Black to shop</button>

                    </a>

                    <a href="{{ route('products.checkout') }}"
                        class="mr-5 rounded-sm bg-green-400 hover:bg-green-700 px-3 py-1 text-white shadow-md">
                        <button class=""> Check out </button>
                    </a>
                  
                </div>

            </div>
        </div>
    </div>

    </div>
    
</div>
</x-guest-layout>
