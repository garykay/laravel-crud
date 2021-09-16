@extends('layouts.app')

@section('content')
    <div class="background-image grid grid-cols-1">

        <div class="flex text-gray-100 pt-10">
            <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block text-center">
                <h1 class="sm:text-white text-5xl uppercase font-bold text-shadow-md pb-14">CPD PORATL</h1>
                <a href="/register"
                    class="text-center bg-gray-50 text-gray-700 py-2 px-4 font-bold text-xl uppercase rounded-md">Register
                    Now</a>
            </div>
        </div>

    </div>
    <div class="container mx-auto mt-10">



        <div class="flex flex-wrap -mx-2 overflow-hidden p-5 md:p-0">

            <div class="my-2 px-2 w-full overflow-hidden sm:w-full lg:w-2/3">
                <h3 class="text-4xl mb-4">Welcome to the CPD Portal</h3>
                <div class="flex flex-wrap overflow-hidden rounded-2xl">


                    <div class="w-full overflow-hidden mt-5">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam aliquet nibh a ullamcorper
                            lobortis. Maecenas molestie placerat magna, ut euismod magna finibus eget. Nunc commodo orci
                            vitae magna vestibulum, et volutpat orci pharetra. Donec et pharetra magna. Nullam commodo sed
                            velit sed interdum. Vivamus in egestas massa. Donec auctor sem finibus, convallis arcu id,
                            viverra est. Duis imperdiet est sed diam fringilla, ac molestie lacus feugiat. Interdum et
                            malesuada fames ac ante ipsum primis in faucibus. Ut cursus metus eros, a semper nibh mollis
                            eget. Aliquam sed maximus risus, non aliquet augue. Mauris pulvinar nunc ut enim consequat
                            aliquet.</p>

                        <p> Ut vestibulum sodales ligula, et consectetur ligula lobortis non. Nullam fermentum leo et ipsum
                            scelerisque sagittis. Donec et ullamcorper felis. Duis tortor erat, maximus ac malesuada eget,
                            sodales ut neque. Etiam et blandit dui. Suspendisse interdum neque id porta sodales. Donec
                            mollis nunc vitae tellus malesuada lacinia. Ut nec ultricies lectus, molestie convallis metus.
                            In eget dolor sem. Donec eget mattis purus, at convallis urna. Quisque vestibulum ut quam eu
                            rhoncus. Maecenas lacinia, purus sit amet malesuada eleifend, magna arcu aliquam enim, quis
                            accumsan est risus id enim.</p>
                    </div>
                </div>
            </div>

            <div class="my-2 px-2 w-full overflow-hidden sm:w-full lg:w-1/3  md:pl-10">
                <h3 class="text-4xl mb-4">Lates News</h3>
                @if (count($posts) < 1)
                        <h2>No posts found</h2>
                @else

                    @foreach ($posts as $post)
                        <div class="flex flex-wrap overflow-hidden rounded-2xl">

                            <div class="post-image w-full overflow-hidden">
                                <img src="{{ asset('images/' . $post->image_path) }}" alt="">
                            </div>

                            <div class="w-full overflow-hidden mt-5">
                                <h5 class="text-4xl">{{ $post->title }}</h5>
                            </div>

                            <div class="w-full overflow-hidden mt-5">
                                <p class="base">{{ $post->excerpt() }} ...</p>
                            </div>
                            <div class="w-full overflow-hidden pt-10 pb-10">
                                <a href="/"
                                    class="text-center border-2 border-gray-700 bg-gray-50 text-gray-700 py-2 px-4 font-bold text-xl uppercase rounded-md">Read
                                    More</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>



    </div>
@endsection
