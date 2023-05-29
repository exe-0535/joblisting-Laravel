<form action="/">
    <div class="relative border-2 border-gray-100 m-4 rounded-lg flex">
        <div class="relative w-1/4 mr-4">
            <div class="absolute top-4 left-3">
                <i
                    class="fa fa-location-arrow text-gray-400 z-20 hover:text-gray-500"
                ></i>
            </div>
            <input
                type="text"
                name="location"
                class="h-14 pl-10 w-full rounded-lg z-0 focus:shadow focus:outline-none"
                placeholder="Location, fe. Warsaw, Tokyo"
            />
            @error('location')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>
        <div class="relative w-1/3 mr-4">
            <div class="absolute top-4 left-3">
                <i
                    class="fa fa-area-chart text-gray-400 z-20 hover:text-gray-500"
                ></i>
            </div>
            <input
                type="number"
                name="range"
                class="h-14 pl-10 w-full rounded-lg z-0 focus:shadow focus:outline-none"
                placeholder="Search scope in km (from 10 to 250)"
            />
            @error('range')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>
        <div class="relative w-full">
            <div class="absolute top-4 left-3">
                <i
                    class="fa fa-search text-gray-400 z-20 hover:text-gray-500"
                ></i>
            </div>
            <input
                type="text"
                name="search"
                class="h-14 pl-10 w-full pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
                placeholder="Search listings by keywords..."
            />
            <div class="absolute top-2 right-2">
                <button
                    type="submit"
                    class="h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600"
                >
                    Search
                </button>
            </div>
        </div>
    </div>
</form>