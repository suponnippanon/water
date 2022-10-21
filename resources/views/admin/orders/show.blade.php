<x-admin-layout>
    <script src="https://cdn.tailwindcss.com"></script>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              
                @if ($orderitems->count()>0 )
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg my-2">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                
                                <th scope="col" class="py-3 px-6">
                                    ชื่อสินค้า
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    ราคาสินค้า
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    จำนวนสินค้า
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($orderitems as $orderitem)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                               
                                   
                                <td class="py-4 px-6">
                                    {{ $orderitem->item_name }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $orderitem->item_price }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $orderitem->item_amount }}
                                </td>
                                @endforeach
    
                            </tr>
                          
                        </tbody>
                    </table>

                    
                @else
                <div class="bg-red-100 border-t border-b border-red-500 text-red-700 px-4 py-3 my-8" role="alert">
                 
                    <p class="text-sm">ไม่มีข้อมูลสินค้าในใบสั่งซื้อ</p>
                </div>
                @endif
  
                
            </div>
            <a href="{{ route('admin.orders.index') }}"
                            class="rounded-lg bg-sky-500 px-4 py-2 text-white hover:bg-sky-700">ย้อนกลับ</a>
        </div>
</x-admin-layout>
    