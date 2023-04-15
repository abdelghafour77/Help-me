<x-home-layout>
    <div class="bg-white dark:bg-gray-900 pt-14 min-h-screen ">

        <div class="flex flex-col p-2 py-6 m-h-screen max-w-screen-lg px-4 mx-auto lg:grid-cols-12 ">

            <form method="POST" action="">
                @csrf
                <div class="mb-6">
                    <label class="block">
                        <span class="text-gray-700">Title</span>
                        <input type="text" name="title" class="block w-full @error('title') border-red-500 @enderror mt-1 rounded-md" placeholder="" value="{{ old('title') }}" />
                    </label>
                    @error('title')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block">
                        <span class="text-gray-700">Slug</span>
                        <input type="text" name="slug" class="block w-full @error('slug') border-red-500 @enderror mt-1 rounded-md" placeholder="" value="{{ old('slug') }}" />
                    </label>
                    @error('slug')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block">
                        <span class="text-gray-700">Description</span>
                        <x-forms.tinymce-editor />
                    </label>
                    @error('description')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="text-white bg-blue-600  rounded text-sm px-5 py-2.5">Submit</button>

            </form>

        </div>

    </div>
    <x-head.tinymce-config />


</x-home-layout>
