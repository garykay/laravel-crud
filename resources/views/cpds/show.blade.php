@extends('layouts.app')
@if (isset(Auth::user()->id) && Auth::user()->id == $cpd->user_id)
@section('content')

    <div class="background-image grid grid-cols-1" style="background-image: url('{{ asset('images/' . $cpd->image_path) }}'); background-attachment: initial;">

        <div class="flex text-gray-100 pt-10">
            <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block text-center">
                <h1 class="sm:text-white text-5xl uppercase font-bold text-shadow-md pb-14">{{ $cpd->title }}</h1>
            </div>
        </div>



    </div>

    <div class="w-4/5 m-auto pt-20">
        <span class="text-gray-500">
            Bt <span class="font-bold italic text-gray-800">{{$cpd->user->name}}, Created on
            {{ date('jS M Y', strtotime($cpd->updated_at)) }}</span>
        </span>

        <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
            {{$cpd->resource}}
        </p>

        <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
                {{$cpd->description}}
            </p>

            @if (isset(Auth::user()->id) && Auth::user()->id == $cpd->user_id)
            <span class="float-right">
                <a href="/cpds/{{ $cpd->slug }}/edit"
                    class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">
                    Edit
                </a>
            </span>

            <span class="float-right">
                <form action="/cpds/{{ $cpd->slug }}" method="POST">
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
@else
@section('content')

<script type="text/javascript">
    window.location = "{{ url('/cpds') }}";//here double curly bracket
</script>
@endsection
@endif
