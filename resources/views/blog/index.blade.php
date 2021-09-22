@extends('layouts.app')

@section('content')

    <div class="background-image grid grid-cols-1">

        <div class="flex text-gray-100 pt-10">
            <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block text-center">
                <h1 class="sm:text-white text-5xl uppercase font-bold text-shadow-md pb-14">Blog</h1>
            </div>
        </div>



    </div>

    @if (count($posts) < 1)
        <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
            <h2 class="text-center">No posts found</h2>
        </div>
    @else



        @foreach ($posts as $post)
            <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
                <div>
                    <img src="{{ asset('images/' . $post->image_path) }}" alt="">
                </div>
                <div>
                    <h2 class="text-gray-700 font-bold text-5xl pb-4">
                        {{ $post->title }}
                    </h2>

                    <span class="text-gray-500">
                        By <span class="font-bold italic text-gray-800">{{ $post->user->name }}</span>, Created on
                        {{ date('jS M Y', strtotime($post->updated_at)) }}
                    </span>

                    <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
                        {{ $post->blog_excerpt() }}
                    </p>

                    <a href="/blog/{{ $post->slug }}"
                        class="uppercase bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
                        Keep Reading
                    </a>

                    @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                        <span class="float-right">
                            <a href="/blog/{{ $post->slug }}/edit"
                                class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">
                                Edit
                            </a>
                        </span>

                        <span class="float-right">
                            <form action="/blog/{{ $post->slug }}" method="POST">
                                @csrf
                                @method('delete')

                                <button class="text-red-500 pr-3" type="submit">
                                    Delete
                                </button>

                            </form>
                        </span>
                    @endif
                </div>
            </div>
        @endforeach

    @endif

@endsection
