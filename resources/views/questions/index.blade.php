<x-home-layout>
    {{-- @dd() --}}
    <div class="pt-20 pb-10 px-4 grid grid-flow-row-dense  grid-cols-1 xl:grid-cols-3 xl:gap-4 bg-white dark:bg-gray-950">
        <div class="p-4 mb-4 col-span-2 bg-gray-50 border border-gray-200 rounded-lg shadow-sm sm:p-6 dark:border-gray-700 dark:bg-gray-800 xl:mb-0">
            {{-- <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Smart chat</h3>
                <a href="#" class="inline-flex items-center p-2 text-sm font-medium rounded-lg text-primary-700 hover:bg-gray-100 dark:text-primary-500 dark:hover:bg-gray-700">
                    View all
                </a>
            </div> --}}
            <!-- Chat -->
            <section class="overflow-y-auto p-2">
                <article class="mb-5">
                    <footer class="flex items-center justify-between mb-7">
                        <H2 class="text-3xl font-bold text-gray-900 dark:text-gray-200">{{ $question->title }}</H2>
                        <button id="dropdownQuestionButton" data-dropdown-toggle="dropdownQuestion"
                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:ring-gray-600" type="button">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                </path>
                            </svg>
                            <span class="sr-only">Comment settings</span>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownQuestion" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-36 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconHorizontalButton">
                                @auth
                                    @if ($question->user_id == Auth::id())
                                        <li>
                                            <a href="question/{{ $question->id }}/edit" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                        </li>
                                        <li>
                                            <form action="/question/{{ $question->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="javascript:;" onclick="this.closest('form').submit()" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</a>
                                            </form>
                                        </li>
                                    @endif
                                @endauth

                                <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                                </li>
                            </ul>
                        </div>
                    </footer>

                    <article class="prose dark:prose-invert max-w-none">
                        {!! $question->description !!}
                    </article>

                </article>
                <h1 class="font-black text-2xl text-gray-900 dark:text-gray-200">{{ __('Answers') }}:</h1>
                <div>



                    @forelse ($question->answers->sortByDesc(function ($answer) {
        return $answer->votes->where('is_upvote', 1)->count();
    }) as $answer)
                        @auth
                            @php
                                if ($answer->votes->where('user_id', Auth::id())->first()) {
                                    if ($answer->votes->where('user_id', Auth::id())->first()->is_upvote == 1) {
                                        $up_class = 'bg-gray-200 dark:bg-gray-500 text-primary-700';
                                        $down_class = 'bg-gray-100 dark:bg-gray-700';
                                        $up = 1;
                                        $down = 0;
                                    } elseif ($answer->votes->where('user_id', Auth::id())->first()->is_upvote == 0) {
                                        $down_class = 'bg-gray-200 dark:bg-gray-500 text-primary-700';
                                        $up_class = 'bg-gray-100 dark:bg-gray-700';
                                        $up = 0;
                                        $down = 1;
                                    }
                                } else {
                                    $up_class = 'bg-gray-100 dark:bg-gray-700';
                                    $down_class = 'bg-gray-100 dark:bg-gray-700 ';
                                    $up = 0;
                                    $down = 0;
                                }
                            @endphp
                        @endauth
                        <article class="grid grid-cols-12 my-8">
                            <div class="col-span-3 md:col-span-1 flex flex-col justify-center items-center mb-2 space-y-2">
                                <button id="btn-upvote-{{ $answer->id }}" type="button" onclick="vote('{{ $answer->id }}','{{ $up ?? '1' == 1 ? '-1' : 1 }}')" class="{{ $up_class ?? 'bg-gray-100 dark:bg-gray-700' }} py-1.5 px-3 inline-flex items-center rounded-lg  hover:bg-gray-200 dark:hover:bg-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l7.5-7.5 7.5 7.5m-15 6l7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <span id="upvote-{{ $answer->id }}" class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                        {{ $answer->votes->where('is_upvote', 1)->count() }}
                                    </span>
                                </button>
                                <button id="btn-downvote-{{ $answer->id }}" type="button" onclick="vote('{{ $answer->id }}','{{ $down ?? '0' == 1 ? '-1' : 0 }}')"
                                    class="{{ $down_class ?? 'bg-gray-100 dark:bg-gray-700' }} py-1.5 px-3 inline-flex items-center rounded-lg bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-600 dark:bg-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 5.25l-7.5 7.5-7.5-7.5m15 6l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                    <span id="downvote-{{ $answer->id }}" class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                        {{ $answer->votes->where('is_upvote', 0)->count() }}
                                    </span>
                                </button>
                            </div>
                            <div class="col-span-9 md:col-span-11">
                                <footer class="flex items-center justify-between mb-2">
                                    <div class="flex items-center">
                                        <p class="inline-flex items-center mr-3 text-sm font-semibold text-gray-900 dark:text-white">
                                            <img class="w-6 h-6 mr-2 rounded-full" src="{{ asset('storage/image/user/' . $answer->user->avatar) }}" alt="{{ $answer->user->full_name }}">
                                            {{ $answer->user->full_name }}
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            <time pubdate datetime="{{ $question->created_at->format('Y-m-d') }}" title="{{ $question->created_at->format('Y-m-d H:m:i') }}">
                                                {{ $answer->created_at->diffForHumans() }}
                                            </time>
                                        </p>
                                    </div>
                                    <button id="dropdownComment-{{ $loop->index }}-Button" data-dropdown-toggle="dropdownComment-{{ $loop->index }}"
                                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:ring-gray-600" type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                            </path>
                                        </svg>
                                        <span class="sr-only">Comment settings</span>
                                    </button>
                                    <!-- Dropdown menu -->
                                    <div id="dropdownComment-{{ $loop->index }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-36 dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconHorizontalButton">
                                            @auth


                                                @if (auth()->user()->id == $answer->user->id)
                                                    <li>
                                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                                    </li>
                                                    <li>
                                                        <form action="/answer/{{ $answer->id }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="javascript:;" onclick="this.closest('form').submit()" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</a>
                                                        </form>
                                                    </li>
                                                @endif
                                            @endauth
                                            <li>
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                                            </li>
                                        </ul>
                                    </div>
                                </footer>
                                <article class="pb-8 prose dark:prose-invert max-w-none @if (!$loop->last) border-b-2 @endif">
                                    {!! $answer->description !!}
                                </article>


                            </div>


                        </article>
                    @empty
                        <p class="text-center font-semibold text-2xl text-gray-900 dark:text-gray-200">{{ __('There is no answers yet !!') }}</p>
                    @endforelse
                </div>
            </section>
        </div>
        <div class="p-4 mb-4 col-span-2 bg-gray-50 border border-gray-200 rounded-lg shadow-sm sm:p-6 dark:border-gray-700 dark:bg-gray-800 xl:mb-0">
            <h1 class="mb-4 font-black text-2xl text-gray-900 dark:text-gray-200">{{ __('Your Answer') }}:</h1>
            <form action="/answer" method="POST">
                @csrf
                <input type="hidden" name="question_id" value="{{ $question->id }}">
                <x-tinymce-editor />
                {{-- error --}}
                @error('desciption')
                    <div class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </div>
                @enderror
                <div class="relative pt-12">

                    <button type="submit" class="absolute bottom-0 right-0 inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        {{ __('Send answer') }}
                    </button>
                </div>
            </form>
        </div>
        <!--Info  -->
        <div class="p-4  bg-gray-50 border border-gray-200 h-fit rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div id="carousel" class="relative" data-carousel="">
                <div class="relative mx-auto overflow-hidden ">
                    <div class=" items-center pb-8">
                        <p class="inline-flex items-center mr-3 text-sm font-semibold text-gray-900 dark:text-white">
                            <img class="w-12 h-12 mr-2 rounded-full" src="{{ asset('/storage/image/user/' . $question->user->avatar) }}"alt="{{ $question->user->full_name }}">
                            {{ $question->user->full_name }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <time pubdate datetime="{{ $question->created_at->format('Y-m-d') }}" title="{{ $question->created_at->format('d/m/Y h:i A') }}">
                                {{--  created at using carbon human diff --}}
                                {{ 'Published ' . $question->created_at->diffForHumans() }}
                            </time>
                        </p>
                    </div>

                    <div class="overflow-x-auto pb-3">
                        <h2 class="text-2xl pb-3 text-gray-900 dark:text-white">{{ __('Tags') }}</h2>
                        @foreach ($question->tags as $tag)
                            @php
                                $c = explode('-', $tag->color)[1] < 400;
                            @endphp
                            <a href="#" class="inline-flex border border-gray-200 shadow-sm items-center px-2 py-1 m-1 text-xs font-medium {{ $c ? 'text-gray-700' : 'text-white' }}  rounded-full bg-{{ $tag->color }}">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                    <div class="pb-3">
                        <h2 class="text-2xl pb-3 text-gray-900 dark:text-white">
                            {{ __('Other Suggestions') }}
                        </h2>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <x-head.tinymce-config />
    <script>
        function vote(id, type) {
            $.ajax({
                url: '/vote',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    answer_id: id,
                    is_upvote: type
                },
                success: function(data) {

                    $('#upvote-' + id).html(data.upvote);
                    $('#downvote-' + id).html(data.downvote);
                    if (data.type == 'up') {
                        $('#btn-upvote-' + id).addClass('text-primary-700');
                        $('#btn-downvote-' + id).removeClass('text-primary-700');
                        // change parametre of onclick function
                        $('#btn-upvote-' + id).attr('onclick', 'vote(' + id + ', ' + -1 + ')');
                        $('#btn-downvote-' + id).attr('onclick', 'vote(' + id + ', ' + 0 + ')');

                    } else if (data.type == 'down') {
                        $('#btn-downvote-' + id).addClass('text-primary-700');
                        $('#btn-upvote-' + id).removeClass('text-primary-700');
                        // change parametre of onclick function
                        $('#btn-upvote-' + id).attr('onclick', 'vote(' + id + ', ' + 0 + ')');
                        $('#btn-downvote-' + id).attr('onclick', 'vote(' + id + ', ' + -1 + ')');

                    } else {
                        $('#btn-upvote-' + id).removeClass('text-primary-700');
                        $('#btn-downvote-' + id).removeClass('text-primary-700');
                        // change parametre of onclick function
                        $('#btn-upvote-' + id).attr('onclick', 'vote(' + id + ', ' + 1 + ')');
                        $('#btn-downvote-' + id).attr('onclick', 'vote(' + id + ', ' + 0 + ')');
                    }
                },
                error: function(data) {
                    flashToast(data.responseJSON.icon, data.responseJSON.message);
                }


            });
        }
    </script>
</x-home-layout>
