<x-admin-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="bg-red-100 border-t border-b border-red-500 text-red-700 px-4 py-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex flex-row items-center justify-between flex-shrink-0 px-8 py-4">
                <p class="font-semibold text-3xl text-blue-400 pl-4">เพิ่มประเภทของสินค้า</p>
            </div>

            <div class="m-2 rounded bg-slate-50 p-2">
                <div class="mt-10 w-full space-y-8 divide-y divide-gray-200">
                    <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="sm:col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                            <div class="mt-1">
                                <input type="text" id="name" name="name"
                                    class="block w-full appearance-none rounded-md border border-gray-400 bg-white py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                        </div>
                        <div class="mt-6 p-4 text-right">
                            <button type="submit"
                                class="rounded-lg bg-green-500 px-4 py-2 text-white hover:bg-green-700">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>

            @if ($categories->count() > 0)
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg my-8">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    รายการ
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    ชื่อประเภทสินค้า
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    จำนวนสินค้าในประเภท
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
                            @foreach ($categories as $category)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $category->id }}
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ $category->name }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $category->products->count() }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                            class="rounded-lg bg-blue-500 px-4 py-2 text-white hover:bg-blue-700">แก้ไข</a>
                                    </td>

                                    <td class="py-4 px-6">
                                        <div class="flex space-x-2">
                                            <form class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                                method="POST"
                                                action="{{ route('admin.categories.destroy', $category->id) }}"
                                                onsubmit="return confirm('ต้องการลบหรือไม่?')">
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
                    {{ $categories->links() }}
                </div>

            @endif


        </div>
    </div>
</x-admin-layout>
