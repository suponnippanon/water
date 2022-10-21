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
    <!-- Main Hero Content -->
    <div class="bg-gradient-to-r  from-zinc-900 via-indigo-900 to-zinc-900 w-full h-full">

        <div class="container max-w-lg px-4 py-32 mx-auto text-left bg-center bg-no-repeat bg-cover md:max-w-none md:text-center"
            style="background-image:  url('{{ asset('storage/template/water2.jpg') }}')">
            <h1
                class="font-mono text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-pink-200 to-pink-400 md:text-center sm:leading-none lg:text-4xl">
                <span class="inline md:block">น้ำดื่ม หยาดทิพย์</span>
            </h1>

            {{-- <div class="flex flex-col items-center mt-12 text-center">
                <span class="relative inline-flex w-full md:w-auto">
                    <a href="" type="button"
                        class="inline-flex items-center justify-center px-6 py-2 text-base font-bold leading-6 text-white bg-green-600 rounded-full lg:w-full md:w-auto hover:bg-green-500 focus:outline-none">
                        Make your Reservation
                    </a>
            </div> --}}
        </div>

        <!-- End Main Hero Content -->

        <section class="mt-8 bg-gradient-to-r  from-zinc-900 via-indigo-900 to-zinc-900 w-full h-full">
            <div class="mt-4 text-center">
                {{-- <h3 class="text-2xl font-bold">Our Menu</h3> --}}
                <h2
                    class="bg-gradient-to-r from-green-400 to-blue-500 bg-clip-text text-3xl font-bold text-transparent">
                    สินค้า</h2>
            </div>

            <div class="container mx-auto w-full px-5 py-6">
                <div class="grid gap-y-6 lg:grid-cols-4">

                    {{-- Product --}}
                    @foreach ($products as $product)
                        <div
                            class="mx-3 flex h-96 flex-col items-center justify-around overflow-hidden rounded-3xl bg-white shadow-md sm:h-52 sm:w-3/5 sm:flex-row md:w-80 hover:bg-blue-100">
                            <img class="h-1/2 w-full object-cover sm:h-full sm:w-1/2" src="{{ asset($product->image) }}"
                                alt="image" />

                            <div
                                class="flex h-1/2 w-full flex-1 flex-col items-baseline justify-around pl-6 sm:h-full sm:w-1/2 sm:items-baseline">
                                <div class="flex flex-col items-baseline justify-start">
                                    <a href="{{ route('products.details', $product->id) }}"
                                        class="mb-0 font-sans text-lg font-normal text-gray-600">{{ $product->name }}</a>
                                    <a href="{{ route('products.details', $product->id) }}"
                                        class="mt-0 text-xs text-indigo-300">{{ $product->category->name }}</a>
                                </div>
                                <p class="w-4/5 text-xs text-gray-500">
                                    {{ Str::limit($product->description, 60, '...') }}</p>
                                <div class="flex w-full items-center justify-between">
                                    <h1 class="font-bold text-gray-500">{{ $product->price }} ฿</h1>
                                    {{-- <button href="{{ route('products.addtocart', $product->id) }}" class="mr-5 rounded-sm bg-green-400 hover:bg-green-700 px-3 py-1 text-white shadow-md">Add</button> --}}
                                    <a href="{{ route('products.addtocart', $product->id) }}"
                                        class="mr-5 rounded-sm bg-green-400 hover:bg-green-700 px-3 py-1 text-white shadow-md">ซื้อ</a>
                                </div>
                            </div>
                        </div>
                    @endforeach



                </div>
                <br>
                {{ $products->appends(['search' => request()->query('search')])->links() }}

            </div>
        </section>

        <section class="px-2 py-32 bg-gradient-to-r  from-zinc-900 via-indigo-900 to-zinc-900 w-full h-full md:px-0">
            <div class="container items-center max-w-6xl px-8 mx-auto xl:px-5">
                <div class="flex flex-wrap items-center sm:-mx-3">
                    <div class="w-full md:w-1/2 md:px-3">
                        <div class="w-full pb-6 space-y-4 sm:max-w-md lg:max-w-lg lg:space-y-4 lg:pr-0 md:pb-0">

                            <h2
                                class="text-2xl font-extrabold tracking-tight text-white sm:text-5xl md:text-4xl lg:text-5xl xl:text-6xl">
                                น้ำดื่มหยาดทิพย์</h2>

                            <p class="mx-auto text-base text-white sm:max-w-md lg:text-xl md:max-w-3xl">
                                <br>

                                ผ่านการกรองด้วยระบบรีเวอร์สออสโมซิส (RO)
                                <br>
                                ฆ่าเชื้อด้วยแสงอุลตร้าไวโอเลต (UV)
                                <br>
                                ผ่านมาตารฐาน GMP
                            </p>

                        </div>
                    </div>
                    <div class="w-full md:w-1/2">
                        <div class="w-full h-auto overflow-hidden rounded-md shadow-xl sm:rounded-xl">
                            <img src="{{ asset('storage/template/pp.jpg') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-gradient-to-r  from-zinc-900 via-indigo-900 to-zinc-900 w-full h-full">
            <div class="container items-center max-w-6xl px-10 mx-auto sm:px-20 md:px-32 lg:px-16">
                <div class="flex flex-wrap items-center -mx-3">
                    <div class="order-1 w-full px-3 lg:w-1/2 lg:order-0">
                        <div class="w-full lg:max-w-md">
                            <h2
                                class="text-2xl font-extrabold tracking-tight text-white sm:text-5xl md:text-4xl lg:text-5xl xl:text-6xl">
                                ที่อยู่ </h2>
                            <p class="mx-auto text-base text-white sm:max-w-md lg:text-xl md:max-w-3xl">
                                <br>

                                บ้านเหล่านกชุม 58 หมู่ 4
                                <br>
                                ต.ดอนหัน อ.เมือง จ.ขอนแก่น
                                <br>
                                รหัสไปรษณีย์ 40260
                                <br>
                                <br>



                            </p>

                            <ul>
                                <h2
                                    class="text-2xl font-extrabold tracking-tight text-white sm:text-5xl md:text-4xl lg:text-5xl xl:text-6xl">
                                    ติดต่อ</h2>
                                <p class="mx-auto text-base text-white sm:max-w-md lg:text-xl md:max-w-3xl">
                                    <br>
                                    <a href="https://www.facebook.com/profile.php?id=100083366259713" type="button"
                                        class="text-white bg-[#3b5998] hover:bg-[#3b5998]/90 focus:ring-4 focus:outline-none focus:ring-[#3b5998]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55 mr-2 mb-2">
                                        <svg class="mr-2 -ml-1 w-4 h-4" aria-hidden="true" focusable="false"
                                            data-prefix="fab" data-icon="facebook-f" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                            <path fill="currentColor"
                                                d="M279.1 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.4 0 225.4 0c-73.22 0-121.1 44.38-121.1 124.7v70.62H22.89V288h81.39v224h100.2V288z">
                                            </path>
                                        </svg>
                                        น้ำดื่มหยาดทิพย์ บ้านเหล่านกชุม
                                    </a>


                                    <br>
                                    <span>โทร 086-8545250 , 094-5093224</span>

                        </div>
                    </div>
                    <div class="w-full px-3 mb-12 lg:w-1/2 order-0 lg:order-1 lg:mb-0"><img
                            class="w-full h-auto overflow-hidden rounded-md shadow-xl sm:rounded-xl"
                            src="{{ asset('storage/template/address.jpg') }}" alt="feature image"></div>
                </div>
            </div>
        </section>


</x-guest-layout>
