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
                    <p class="font-semibold text-3xl text-blue-400 pl-4">แก้ไขประเภทสินค้า</p>
                </div>
                <div class="m-2 rounded bg-slate-50 p-2">
                    <div class="mt-10 w-full space-y-8 divide-y divide-gray-200">
                        <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="sm:col-span-6">
                                <label for="name" class="block text-sm font-medium text-gray-700"> ชื่อประเภทสินค้า </label>
                                <div class="mt-1">
                                    <input type="text" id="name" name="name" value="{{ $category->name }}"
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
            </div>
        </div>
</x-admin-layout>
    