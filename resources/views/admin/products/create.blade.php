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
                <p class="font-semibold text-3xl text-blue-400 pl-4">เพิ่มสินค้า</p>

                <div class="flex justify-end m-2 p-2">
                    <a href="{{ route('admin.products.index') }}"
                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">สินค้า</a>
                </div>
            </div>

            <div class="m-2 rounded bg-slate-50 p-2">
                <div class="mt-10 w-full space-y-8 divide-y divide-gray-200">
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="sm:col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700"> ชื่อ </label>
                            <div class="mt-1">
                                <input type="text" id="name" name="name"
                                    class="block w-full appearance-none rounded-md border border-gray-400 bg-white py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-indigo-500 focus:ring-indigo-500" />
                            </div>
                        </div>
                        <div class="pt-5 sm:col-span-6">
                            <label for="body" class="block text-sm font-medium text-gray-700">รายระเอียด</label>
                            <div class="mt-1">
                                <textarea id="body" rows="3" name="description"
                                    class="block w-full appearance-none rounded-md border border-gray-400 bg-white py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="sm:col-span-6">
                            <label for="image" class="block text-sm font-medium text-gray-700"> รูปภาพ </label>
                            <div class="mt-1">
                                <input type="file" id="image" name="image"
                                    class="block w-full appearance-none rounded-md border border-gray-400 bg-white py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-indigo-500 focus:ring-indigo-500" />
                            </div>
                        </div>
                        <div class="pt-5 sm:col-span-6">
                            <label for="category" class="block text-sm font-medium text-gray-700">ประเภทสินค้า</label>
                            <div class="mt-1">
                                <select id="category" name="category"
                                    class="block w-full appearance-none rounded-md border border-gray-400 bg-white py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-indigo-500 focus:ring-indigo-500">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="sm:col-span-6">
                            <label for="price" class="block text-sm font-medium text-gray-700"> ราคา </label>
                            <div class="mt-1">
                                <input type="number" min="0.00" max="10000.00" step="0.01" id="price" name="price"
                                    class="block w-full appearance-none rounded-md border border-gray-400 bg-white py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-indigo-500 focus:ring-indigo-500" />
                            </div>
                        </div>



                </div>
                <div class="mt-6 p-4 text-right">
                    <button type="submit"
                        class="rounded-lg bg-green-500 px-4 py-2 text-white hover:bg-green-700">บันทึก</button>
                </div>
                </form>
            </div>
        </div>

    </div>
    </div>
</x-admin-layout>
