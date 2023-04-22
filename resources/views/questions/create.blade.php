<x-home-layout>
    <div class="bg-white dark:bg-gray-950 pt-14 min-h-screen ">
        <div class="p-4 mb-4 col-span-2  sm:p-6 xl:mb-0">
            <div class="flex flex-col p-2 py-6 m-h-screen max-w-screen-lg px-4 mx-auto bg-gray-50 border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 lg:grid-cols-12 ">

                <form method="POST" action="">
                    @csrf
                    <div class="mb-6">
                        <label class="block">
                            <span class="text-gray-700 dark:text-white">Title</span>
                            <input type="text" name="title"
                                class="@error('title') border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="" value="{{ old('title') }}" />
                        </label>
                        @error('title')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="exampletags" class="text-gray-700 dark:text-white">Tags</label>
                        <input type="text" name="tags" id="tags" value="{{ old('tags') }}"
                            class="tagify w-full leading-5 relative text-sm py-2 px-4 rounded text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600" id="exampletags"
                            minlength="2">
                    </div>
                    <div class="mb-6">
                        <label class="block">
                            <span class="text-gray-700 dark:text-white">Description</span>
                            <x-tinymce-editor />
                        </label>
                        @error('description')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="text-white bg-blue-600  rounded text-sm px-5 py-2.5">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <x-head.tinymce-config />
</x-home-layout>
