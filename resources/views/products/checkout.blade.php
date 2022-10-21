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
    <div class="bg-gradient-to-r from-sky-300 to-blue-600 w-full h-full">
        <div class="container w-full px-5 py-6 mx-auto">

            <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
                <div class="flex flex-col md:flex-row">
                    <div class="h-32 md:h-auto md:w-1/2">
                        <img class="object-cover w-full h-full" src="{{ asset('storage/template/checkbill2.jpg') }}"
                            alt="img" />
                    </div>
                    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                        <div class="w-full">
                            <h3 class="mb-4 text-xl font-bold text-blue-600">กรอกข้อมูลการสั่งซื้อ</h3>

                            <div class="w-full bg-gray-200 rounded-full">
                                <div
                                    class="w-100 p-1 text-xs font-medium leading-none text-center text-green-100 bg-green-600 rounded-full">
                                </div>
                            </div>

                            <form method="POST" action="{{ route('products.createorder') }}">
                                @csrf

                                <div class="sm:col-span-6">
                                    <label for="email" class="block text-sm font-medium text-gray-700"> Email
                                    </label>
                                    <div class="mt-1">
                                        <input type="email" id="email" name="email" value=""
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') is-invalid @enderror" />
                                    </div>
                                    @error('email')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="sm:col-span-6">
                                    <label for="fname" class="block text-sm font-medium text-gray-700"> First Name
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" id="fname" name="fname" value=""
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('fname') is-invalid @enderror" />
                                    </div>
                                    @error('fname')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="sm:col-span-6">
                                    <label for="lname" class="block text-sm font-medium text-gray-700"> Last Name
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" id="lname" name="lname" value=""
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('lname') is-invalid @enderror" />
                                    </div>
                                    @error('lname')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="sm:col-span-6">
                                    <label for="address" class="block text-sm font-medium text-gray-700"> Address
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" id="address" name="address" value=""
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('address') is-invalid @enderror" />
                                    </div>
                                    @error('address')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="sm:col-span-6">
                                    <label for="last_name" class="block text-sm font-medium text-gray-700"> Zip/Postal
                                        code
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" id="zip" name="zip" value=""
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('zip') is-invalid @enderror" />
                                    </div>
                                    @error('zip')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="sm:col-span-6">
                                    <label for="phone" class="block text-sm font-medium text-gray-700"> Phone
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" id="phone" name="phone" value=""
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('phone') is-invalid @enderror" />
                                    </div>
                                    @error('phone')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="pt-5 sm:col-span-6">
                                    <label for="village_name"
                                        class="block text-sm font-medium text-gray-700">Village</label>
                                    <div class="mt-1">
                                        <select id="village_name" name="village_name"
                                            class="block w-full appearance-none rounded-md border border-gray-400 bg-white py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-indigo-500 focus:ring-indigo-500">
                                            @foreach ($villages as $village)
                                                <option value="{{ $village->name }}">{{ $village->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                <div class="mt-6 p-4 flex justify-end">
                                    <button type="submit"
                                        class="px-4 py-2 bg-green-400 hover:bg-green-700 shadow-md rounded-lg text-white">ยืนยัน</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</x-guest-layout>
