<x-admin-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            
            <div class="flex flex-row items-center justify-between flex-shrink-0 px-8 py-4">
                <p class="font-semibold text-3xl text-blue-400 pl-4">สินค้า</p>
                <div class="flex justify-end m-2 p-2">
                    <a href="{{ route('admin.products.create') }}"
                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">เพิ่มสินค้า</a>
                </div>
            </div>

            @if ($products->count()>0 )
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg my-2">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                รายการ
                            </th>
                            <th scope="col" class="py-3 px-6">
                                รูปภาพ
                            </th>
                            <th scope="col" class="py-3 px-6">
                                ชื่อ
                            </th>
                            <th scope="col" class="py-3 px-6">
                                รายระเอียด
                            </th>
                            <th scope="col" class="py-3 px-6">
                                ประเภทสินค้า
                            </th>
                            <th scope="col" class="py-3 px-6">
                                ราคา
                            </th>
                            <th scope="col" class="py-3 px-6">
                                แก้ไข
                            </th>
                            <th scope="col" class="py-3 px-6">
                                ลบ
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($products as $product)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $product->id }}
                            </th>
                            <td class="py-4 px-6">
                                <img src="{{asset($product->image)}}" class="w-20 h-20 rounded">
                            </td>
                            <td class="py-4 px-6">
                                {{ $product->name }}
                            </td>
                            <td class="py-4 px-6">
                                {{ Str::limit($product->description, 40, "...") }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $product->category->name }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $product->price }}
                            </td>
                            <td class="py-4 px-6">
                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                    class="rounded-lg bg-blue-500 px-4 py-2 text-white hover:bg-blue-700">แก้ไข</a>
                            </td>

                            <td class="py-4 px-6">
                                <div class="flex space-x-2">
                                    <form class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                        method="POST" action="{{ route('admin.products.destroy', $product->id) }}" onsubmit="return confirm('ต้องการลบหรือไม่?')">
                                        @csrf
                                        @method('delete')
                                        <button type="submit">ลบ</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
            @else
            <div class="bg-red-100 border-t border-b border-red-500 text-red-700 px-4 py-3 my-8" role="alert">
             
                <p class="text-sm">ไม่มีข้อมูลสินค้า</p>
            </div>

        @endif




        </div>
    </div>
</x-admin-layout>
