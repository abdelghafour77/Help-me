<x-home-layout>
    <div class="bg-white dark:bg-gray-900 pt-14 min-h-screen ">

        <div class="flex flex-col p-2 py-6 m-h-screen max-w-screen-lg px-4 mx-auto lg:grid-cols-12 ">
            <form action="/search/">
                <div class="bg-white dark:bg-gray-700 items-center justify-between w-full flex rounded-full shadow-md p-2 mb-5">

                    <input class="font-bold rounded-full w-full py-4 pl-4 text-gray-700 bg-gray-100 dark:bg-gray-600 dark:text-gray-200 leading-tight focus:outline-none focus:shadow-outline lg:text-sm text-xs" value="{{ old('search', request()->get('search')) }}" name="search" type="text" placeholder="Search">
                    <button type="submit" class="bg-gray-600 p-2 hover:bg-blue-400 cursor-pointer mx-2 rounded-full">
                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </button>

                </div>
            </form>

            <div class="pt-5 flex justify-between wrapper items-center">
                <div class="px-3">
                    <div class="lg:text-lg md:text-lg text-sm lg:pt-1 p-1 font-black text-gray-500">
                        {{ $questions->total() }} results
                    </div>
                </div>
                <div>
                    <a href="/askQuestion" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Ask Question
                    </a>

                </div>
            </div>

            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($questions as $question)
                    <li class="py-12">
                        <article>
                            <div class="space-y-2 xl:grid xl:grid-cols-4 xl:items-baseline xl:space-y-0">
                                <dl>
                                    <dt class="sr-only">Published on</dt>
                                    <dd class="text-base font-medium leading-6 text-gray-500 dark:text-gray-400">
                                        <time datetime="{{ $question->created_at->format('Y-m-d H:i:s') }}">
                                            {{ $question->created_at->diffForHumans() }}
                                        </time>
                                    </dd>
                                </dl>
                                <div class="space-y-5 xl:col-span-3">
                                    <div class="space-y-6">
                                        <div>
                                            <h2 class="text-2xl font-bold leading-8 tracking-tight pb-4">
                                                <a class="text-gray-900 dark:text-gray-100" href="/question/{{ $question->slug }}">
                                                    {{ $question->title }}
                                                </a>
                                            </h2>
                                            <div class="flex flex-wrap gap-2">
                                                {{-- foreach max 5 $question->tags --}}
                                                @foreach ($question->tags->slice(0, 7) as $tag)
                                                    @php
                                                        $c = explode('-', $tag->color)[1] < 400;
                                                    @endphp
                                                    <a href="/tag/{{ $tag->slug }}" class="{{ $c ? 'text-gray-700' : 'text-white' }}  rounded-full bg-{{ $tag->color }} text-xs font-medium inline-flex items-center px-2.5 py-0.5 border rounded-full">
                                                        {{ $tag->name }}
                                                    </a>
                                                @endforeach


                                            </div>
                                        </div>
                                        <div class="prose w-3/4 text-gray-500 dark:text-gray-400">
                                            <section class="prose dark:prose-invert max-w-none truncate text-ellipsis">
                                                {!! strip_tags($question->description) !!} {{-- limit 200 characters --}}

                                            </section>
                                        </div>
                                    </div>
                                    <div class="text-base font-medium leading-6">
                                        <a class="text-primary-500 hover:text-primary-600 dark:hover:text-primary-400" href="/question/{{ $question->slug }}">Read more →</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </li>
                @endforeach

            </ul>
            {{ $questions->links() }}
        </div>


    </div>
</x-home-layout>
