<x-admin-layout>
    <script src="https://cdn.tailwindcss.com"></script>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              
                @if ($orders->count()>0 )
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg my-2">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    รายการสั่งซื้อ
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    หมู่บ้าน
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    ที่อยู่
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    เวลาสั่งซื้อ
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    ราคา
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    สถานะการชำระเงิน
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    ชื่อ
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    เบอร์โทร
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    รายระเอียด
                                </th>
                              
    
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($orders as $order)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $order->order_id }}
                                </th>
                                <td class="py-4 px-6">
                                    {{ $order->village_name }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $order->address }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $order->date }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $order->price }}
                                </td>
                                <td class="py-4 px-6">
                                   
                                    @if ($order->status=='Not Paid')
                                    <span class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $order->status }}</span>
                                    @else
                                    <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $order->status }}</span>
                                    @endif
                                   
                                   
                                </td>


                                <td class="py-4 px-6">
                                    {{ $order->fname }}
                                </td>

                                <td class="py-4 px-6">
                                    {{ $order->phone }}
                                </td>
                            
                               
                                <td class="py-4 px-6">
                                    <a href="{{ route('admin.orders.show', $order->order_id) }}"
                                        class="rounded-lg bg-sky-500 px-4 py-2 text-white hover:bg-sky-700">รายระเอียด</a>
                                </td>
                                @endforeach
    
                                {{-- <td class="py-4 px-6">
                                    <div class="flex space-x-2">
                                        <form class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                            method="POST" action="" onsubmit="return confirm('ต้องการลบหรือไม่?')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit">Delete</button>
                                        </form>
                                    </div>
                                </td> --}}
                            </tr>
                          
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>
                @else
                <div class="bg-red-100 border-t border-b border-red-500 text-red-700 px-4 py-3 my-8" role="alert">
                 
                    <p class="text-sm">ไม่มีข้อมูลการสั่งซื้อ</p>
                </div>
                @endif
  
            </div>
        </div>
</x-admin-layout>
    