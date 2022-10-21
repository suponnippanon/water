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

    <div class="py-32 bg-gradient-to-r  from-zinc-900 via-indigo-900 to-zinc-900 w-full h-full">
        <div class="flex w-full flex-col justify-center space-y-6 bg-gray-50 px-4 py-6 dark:bg-gray-800 md:p-6 xl:p-8">
            <h3 class="text-xl font-semibold leading-5 text-gray-800 dark:text-white">สถานะ</h3>
            <div class="flex w-full items-start justify-between">
                <div class="flex items-center justify-center space-x-4">
                    <div class="h-8 w-8">
                        <img class="h-full w-full" alt="logo" src="https://i.ibb.co/L8KSdNQ/image-3.png" />
                    </div>
                    <div class="flex flex-col items-center justify-start">
                        @if ($payment_info['status'] == 'Not Paid')
                            <p class="text-lg font-semibold leading-6 text-gray-800 dark:text-white">
                                ยังไม่ชำระเงิน<br /><span class="font-normal">รอดำเนินการส่งสินค้า</span></p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="lg:px-2 lg:w-1/2">
                <div class="p-4 bg-gray-100 rounded-full">
                    <h1 class="ml-2 font-bold uppercase"> Total {{ number_format($payment_info['price']) }}</h1>
                </div>
            </div>

            <div class="flex justify-center">
           
                  <a href="{{ route('products.index') }}" class="w-96 h-12 inline-block px-6 py-2.5 bg-orange-400 text-white text-center font-bold leading-tight uppercase rounded shadow-md hover:bg-orange-500 hover:shadow-lg focus:bg-orange-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-orange-600 active:shadow-lg transition duration-150 ease-in-out"
                  >ชำระเงินปลายทาง</a>

                
            </div>


            <div class="flex justify-center w-full" id="paypal-button-container"></div>


            <div class="flex justify-start">
                <a href="{{ route('products.index') }}" class="flex font-semibold text-indigo-600 text-sm mt-10">
                    <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                        <path
                            d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                    </svg>
                    Continue Shopping
                </a>
            </div>

        </div>

    </div>
    <!-- Replace "test" with your own sandbox Business account app client ID -->
    <script
        src="https://www.paypal.com/sdk/js?client-id=AQdX4cgbYCVg8P6GRoA09XrIhXxELiaRWzOuwERIMGW06tUMYP4sJahEybW0s9qRxcgKfFWXei-pswTA">
    </script>
    <!-- Set up a container element for the button -->
    <div id="paypal-button-container"></div>
    <script>
        paypal.Buttons({
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ $payment_info['price'] }}' // Can also reference a variable or function
                        }
                    }]
                });
            },
            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {
                return actions.order.capture().then(function(details) {
                  window.location='/paymentreceipt/'+data.orderID+'/'+data.payerID;

                });
            }
        }).render('#paypal-button-container');
    </script>




</x-guest-layout>
