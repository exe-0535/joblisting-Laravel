<section
    class="relative h-72 bg-laravel flex flex-col justify-center align-center text-center space-y-4 mb-4"
>
    <div
        class="absolute top-0 left-0 w-full h-full opacity-10 bg-no-repeat bg-center"
        style="background-image: url('images/laravel-logo.png')"
    ></div>

    <div class="z-10">
        <h1 class="text-6xl font-bold uppercase text-white">
            Lara<span class="text-black">Gigs</span>
        </h1>
        <p class="text-2xl text-gray-200 font-bold my-4">
            Best IT Listings Service
        </p>
        @hasanyrole('employer|seeker')

        @else
        <div>
            <a href="/register/role" class="inline-block font-semibold border-2 border-white text-white py-2 px-4 uppercase mt-2 hover:text-black hover:border-black">
                Start <span class="text-black">Now</span>
            </a>
        </div>
        @endhasanyrole
    </div>
</section>