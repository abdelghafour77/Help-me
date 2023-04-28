<x-dashboard-layout>
    <x-dashboard.colors />
    <div class="m-4 my-6 p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <!-- Card header -->
        <div class="items-center justify-between lg:flex">
            <div class="mb-4 lg:mb-0">
                <h3 class="mb-2 text-xl font-bold uppercase text-gray-900 dark:text-white">Tags</h3>
                <span class="text-base font-normal text-gray-500 dark:text-gray-400">This is a list of all Tags</span>
            </div>
            <div class="items-center sm:flex">
                {{-- button add tag --}}
                <a onclick="addtag()" data-drawer-target="drawer-tag" data-drawer-show="drawer-tag" aria-controls="drawer-tag" data-drawer-placement="right"
                    class="flex items-center justify-center px-4 py-2 mb-2 text-sm font-medium text-white bg-green-500 border border-transparent rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mb-0 sm:mr-2">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v4h4a1 1 0 110 2h-4v4a1 1 0 11-2 0v-4H5a1 1 0 110-2h4V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Add Tag</span>
                </a>
            </div>
        </div>
        <!-- Table -->
        <div class="pt-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5">
            @foreach ($tags as $tag)
                <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-end px-4 pt-4">
                        <button id="dropdownButton" data-dropdown-toggle="dropdown2-{{ $tag->id }}"
                            class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                            <span class="sr-only">Open dropdown</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdown2-{{ $tag->id }}" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2" aria-labelledby="dropdownButton">
                                <li>
                                    <a href="tag/{{ $tag->slug }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">View</a>
                                </li>
                                <li>
                                    <a onclick="editetag({{ $tag->id }})" data-drawer-target="drawer-tag" data-drawer-show="drawer-tag" aria-controls="drawer-tag" data-drawer-placement="right"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                                </li>
                                <li>
                                    <form action="tags/{{ $tag->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="#"onclick="event.preventDefault();this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                                    </form>
                                    {{-- <a href="" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a> --}}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex flex-col items-center pb-10">
                        <img class="h-24 mb-3" src="{{ asset('storage/image/tag/' . $tag->image) }}" alt="Bonnie image" />
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $tag->name }}</h5>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $tag->description }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- drawer --}}
    <div id="drawer-tag" aria-hidden="true" class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform translate-x-full bg-white dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
        <h5 id="title-edit" class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">Edit Tag</h5>
        <h5 id="title-add" class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">Add Tag</h5>
        <button type="button" data-drawer-dismiss="drawer-tag" aria-controls="drawer-tag"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>


        <form action="" method="POST" id="tag_form" enctype="multipart/form-data">
            @csrf

            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach

            <div class="space-y-4" x-data="{ slug_name: '' }">
                <input type="hidden" name="id" id="id" value="">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Name') }}</label>
                    <input type="text" x-model="slug_name" name="name" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="{{ __('Name') }}" required="">
                </div>
                {{-- <div>
                    <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Slug') }}</label>
                    <input x-slug="slug_name" type="text" name="slug" id="slug"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-200 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="{{ __('Slug') }}" required="" disabled>
                </div> --}}
                <div class="">
                    <div x-data="app()" x-init="[initColor()]">
                        <div>
                            <label for="color" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a color</label>
                            <div class="flex flex-row relative">
                                <input id="color"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    x-model="currentColor" name="color">
                                <div @click="isOpen = !isOpen" class="cursor-pointer rounded-full ml-3 my-auto h-10 w-10 flex" :class="`bg-${currentColor}`">
                                    <svg xmlns="http://www.w3.org/2000/svg" :class="`${iconColor}`" class="h-6 w-6 mx-auto my-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                    </svg>
                                </div>
                                <div x-show="isOpen" @click.away="isOpen = false" x-transition:enter="transition ease-out duration-100 transform" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75 transform" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                    class="border z-30 border-gray-300 origin-top-right absolute right-0 top-full mt-2 rounded-md shadow-lg">
                                    <div class="rounded-md bg-white shadow-xs p-2">
                                        <div class="flex">
                                            <template x-for="color in colors">
                                                <div class="">
                                                    <template x-for="variant in variants">
                                                        <div @click="selectColor(color,variant)" class="cursor-pointer w-6 h-6 rounded-full mx-1 my-1" :class="`bg-${color}-${variant}`"></div>
                                                    </template>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Description') }}</label>
                    <textarea name="description" id="description" placeholder="{{ __('Description') }}" rows="4"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        required=""></textarea>

                </div>
                <div class="relative">
                    <div id="image" x-data="fileUpload" :class="imageUrl && 'border-blue-600 dark:border-blue-500'"
                        class="@error('image') border-red-500 hover:border-red-600 @enderror flex justify-center items-center border-2 border-gray-300 hover:border-blue-500 hover:bg-gray-300 dark:hover:bg-gray-800 hover:bg-opacity-25 dark:border-dark-line border-dashed rounded-md h-36 overflow-y-hidden">
                        <template x-if="!imageUrl">
                            <label class="space-y-1 cursor-pointer text-center px-6 pt-5 pb-6 w-full" for="image">
                                <svg aria-hidden="true" class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" />
                                </svg>
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    <label class="relative bg-transparent rounded-md font-medium text-blue-600 dark:text-blue-500">
                                        <p class="text-gray-500 dark:text-white space-y-1">
                                            <span class="text-blue-600 dark:text-blue-500">Upload a Image</span>
                                            or drag and drop
                                            <span class="block text-xs text-gray-500">PNG, JPG up to 5MB</span>
                                        </p>
                                    </label>
                                </div>
                            </label>

                        </template>

                        <template x-if="imageUrl">
                            <div class="object-contain group relative">
                                <div class="hidden group-hover:flex absolute justify-center items-center m-auto text-white tracking-wider uppercase bg-transparent h-full w-full hover:bg-black/75 hover:cursor-pointer" x-on:click="imageUrl = ''">
                                    Remove
                                </div>
                                <img :src="imageUrl" alt="" x-bind:class="{ 'hidden': !imageUrl }">
                            </div>
                        </template>

                        <input class="sr-only" name="image" type="file" x-on:change="selectFile">
                        <input value="" id="post_header_delete" name="post_header_delete" type="hidden" />
                    </div>
                    @error('image')
                        <div class="text-sm mt-0 text-red-600 dark:text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <div>
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Image') }}</label>
                    <input type="text" name="image" id="image"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="{{ __('Image') }}" required="">
                </div> --}}

                <div id="btn-edit">
                    <div class="bottom-0 left-0 flex justify-center w-full pb-4 space-x-4 md:px-4 md:absolute">
                        <button type="submit"
                            class="text-white w-full justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Update Tag
                        </button>
                    </div>
                </div>
                <div id="btn-add">
                    <button type="submit"
                        class="text-white w-full justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Create Tag
                    </button>
                </div>


        </form>
    </div>
    <script>
        // get user using ajax
        function editetag(id) {
            // hide #btn-add
            $('#btn-add').hide();
            $('#title-add').hide();
            // show #btn-edit
            $('#btn-edit').show();
            $('#title-edit').show();
            // add method put
            $('#tag_form').attr('action', '/tags/' + id);
            $('#tag_form').attr('method', 'POST');
            $('#tag_form').append('@method('PUT')');

            $.ajax({
                url: '/admin/tag/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#slug').val(data.slug);
                    $('#description').val(data.description);
                    $('#color').val(data.color);
                    // trigger  #color using alpine js
                    document.getElementById('color').dispatchEvent(new Event('input'));
                    // change src img inside #image
                    $('#image img').attr('src', 'http://127.0.0.1:8000/storage/image/tag/' + data.image);

                }

            });
        }

        function addtag() {
            // show #btn-add
            $('#btn-add').show();
            $('#title-add').show();
            // hide #btn-edit
            $('#btn-edit').hide();
            $('#title-edit').hide();
            // remove method put
            $('#tag_form').attr('action', '/tags');
            $('#tag_form').attr('method', 'POST');
            $('#tag_form').find("input[name='_method']").remove();
            // clear input
            $('#id').val('');
            $('#name').val('');
            $('#slug').val('');
            $('#description').val('');
            // trigger  #color using alpine js
            document.getElementById('color').dispatchEvent(new Event('input'));
            // change src img inside #image
            $('#image img').attr('src', '');

        }




        document.addEventListener('alpine:init', () => {
            Alpine.data('fileUpload', () => ({
                imageUrl: 'http://127.0.0.1:8000/storage/image/tag/laravel.png',
                selectFile(event) {
                    const file = event.target.files[0]
                    const reader = new FileReader()
                    if (event.target.files.length < 1) {
                        return
                    }
                    reader.readAsDataURL(file)
                    reader.onload = () => (this.imageUrl = reader.result)
                },
            }))
        })
    </script>
    <script>
        function app() {
            return {
                colors: ['gray', 'red', 'yellow', 'green', 'blue', 'indigo', 'purple', 'pink'],
                variants: [100, 200, 300, 400, 500, 600, 700, 800, 900],
                currentColor: '',
                iconColor: '',
                isOpen: false,
                initColor() {
                    this.currentColor = 'red-800'
                    this.setIconWhite()
                },
                setIconWhite() {
                    this.iconColor = 'text-white'
                },
                setIconBlack() {
                    this.iconColor = 'text-black'
                },
                selectColor(color, variant) {
                    this.currentColor = color + '-' + variant
                    if (variant < 500) {
                        this.setIconBlack()
                    } else {
                        this.setIconWhite()
                    }
                }
            }
        }
    </script>
</x-dashboard-layout>
