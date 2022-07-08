@extends('layouts.app')

@section('content')

    <div class="background-image grid grid-cols-1" style="background-image: url('{{ asset('images/' . $post->image_path) }}'); background-attachment: initial;">

        <div class="flex text-gray-100 pt-10">
            <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block text-center">
                <h1 class="sm:text-white text-5xl uppercase font-bold text-shadow-md pb-14">{{ $post->title }}</h1>
            </div>
        </div>



    </div>

    <div class="w-4/5 m-auto pt-20">
        <span class="text-gray-500">
            By <span class="font-bold italic text-gray-800">{{$post->user->name}}, Created on
            {{ date('jS M Y', strtotime($post->updated_at)) }}</span>
        </span>

        <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
                {{$post->description}}
            </p>

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

@endsection
