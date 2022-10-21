<x-guest-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <nav class="bg-gray-200 shadow-md dark:bg-gray-700">
        <div class="py-3 px-4 md:px-6">
          <div class="flex justify-end">
            <ul class="mt-1 mr-2 flex flex-row space-x-1 text-sm font-medium">
                <div class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-green-500 hover:text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <a xlink:href="{{ route('products.showcart')}}">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                  </a>
                </svg>
                @if(isset($cartItems))
                <span class="mr-2 h-6 rounded bg-red-500 px-2.5 py-0.5 text-xs font-semibold text-white"
                >{{ $cartItems->totalQuantity }}</span>
                @endif
                </div>
            <div class="relative mx-auto pt-2 text-gray-600">
                <form action="{{ route('products.search') }}" method="GET">
                  <input class="h-10 rounded-lg border-2 border-gray-300 bg-white px-5 pr-16 text-sm focus:outline-none" type="search" name="search" placeholder="Search" />
                  <button type="submit" class="absolute right-0 top-0 mt-5 mr-4">
                    <svg class="h-4 w-4 fill-current text-gray-600" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                      <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                    </svg>
                    
                  </button>
                </form>
            </div>
            </ul>
          </div>
        </div>
    </nav>
    <div class = "bg-gradient-to-r from-gray-900 bg-teal-900 w-full h-full">
    <div class="py-12">
        {{-- <section class="body-font overflow-hidden bg-white text-gray-700"> --}}
            <div class="container mx-auto px-5 py-24">
                <div class="mx-auto flex flex-wrap lg:w-4/5">
                    <img alt="ecommerce" class="w-full rounded border border-gray-200 object-cover object-center lg:w-1/2"
                        src="{{ asset($product->image) }}" />
                    <div class="mt-6 w-full lg:mt-0 lg:w-1/2 lg:py-6 lg:pl-10">
                        <h2 class="title-font text-sm tracking-widest text-gray-300">น้ำดื่มหยาดทิพย์</h2>
                        <h1 class="title-font mb-1 text-3xl font-medium text-white">{{ $product->name }}</h1>

                        <p class="leading-relaxed text-gray-100">{{ $product->description }}</p>

                        <form action="{{ route('products.addquantitytocart') }}" method="post">
                            @csrf
                            <div class="mt-6 mb-5 flex items-center border-b-2 border-gray-200 pb-5">
                                <div class="ml-2 flex items-center">
                                    <input type="hidden" name="_id" value="{{ $product->id }}">
                                    <span class="mr-3 text-gray-50">quality</span>
                
                                        <div class="relative">
                                            <div class="sm:col-span-6">
                                                <div class="mt-1">
                                                    <input type="text" id="price" name="quantity" value="1"
                                                        class="block w-14 appearance-none rounded-md border border-gray-400 bg-gray-50 py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-indigo-500 focus:ring-indigo-500" />
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                </div>
                            </div>
                            <div class="flex">
                                <span class="title-font text-2xl font-medium text-white">{{ $product->price }} บาท</span>
                                <button type="submit"
                                    class="ml-auto flex rounded border-0 bg-green-400 py-2 px-6 text-white hover:bg-green-600 focus:outline-none">เพิ่มสินค้าลงในตะกร้า</button>
                            </div>
                           
                        </form>
               
                       
                    </div>
                </div>
            </div>
        {{-- </section> --}}
    </div>
    </div>
</x-guest-layout>
