<form action="/">
    <div class="relative border-2 border-gray-100 m-4 flex flex-wrap">
        <div class="flex w-full mb-2">
            <div class="relative w-1/4 mr-4">
                <div class="absolute top-4 left-3">
                    <i
                        class="fa fa-location-arrow text-gray-400 z-20 hover:text-gray-500"
                    ></i>
                </div>
                <input
                    type="text"
                    name="location"
                    class="h-14 pl-10 w-full  z-0 focus:shadow focus:outline-none text-ellipsis"
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
                    class="h-14 pl-10 w-full  z-0 focus:shadow focus:outline-none text-ellipsis"
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
                    class="h-14 pl-10 w-full pr-20  z-0 focus:shadow focus:outline-none text-ellipsis"
                    placeholder="Search listings by keywords"
                />
                <div class="absolute top-2 right-2">
                    <button
                        type="submit"
                        class="h-10 w-20 text-white  bg-red-500 hover:bg-red-600"
                    >
                        Search
                    </button>
                </div>
            </div>
        </div>
        <div class="flex w-full">
            <!-- Categories -->
            <div class="relative w-1/3 mr-4 border border-gray-500 flex items-center justify-center">
                <a id="dropdownCheckboxCategories" data-dropdown-toggle="dropdownCategories" class="text-gray-600 px-4 py-2.5 text-center inline-flex items-center" role="button">Categories<i class="fa-solid fa-chevron-down ml-3"></i></a>

                <!-- Dropdown menu for categories -->
                <div id="dropdownCategories" class="z-10 hidden w-full bg-white divide-y divide-gray-100 border border-gray-500 max-h-40 overflow-y-scroll">
                    <ul class="p-3 space-y-3 text-sm " aria-labelledby="dropdownCheckboxCategories">
                        @foreach($tags->where('type', '=', 'category') as $tag)
                            <li>
                                <div class="flex items-center">
                                    <input id="checkbox-item-1" type="checkbox" name="tags[{{$tag->name}}]" class="w-4 h-4 text-laravel border-gray-500 focus:ring-0 focus:ring-offset-0">
                                    <label for="checkbox-item-1" class="ml-2 text-sm font-medium text-gray-600">{{$tag->name}}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Experience -->
            <div class="relative w-1/3 mr-4 border border-gray-500 flex items-center justify-center">
                <a id="dropdownCheckboxExperience" data-dropdown-toggle="dropdownExperience" class="text-gray-600 px-4 py-2.5 text-center inline-flex items-center" role="button">Experience<i class="fa-solid fa-chevron-down ml-3"></i></a>

                <!-- Dropdown menu for experience -->
                <div id="dropdownExperience" class="z-10 hidden w-full bg-white divide-y divide-gray-100 border border-gray-500 max-h-40 overflow-y-scroll">
                    <ul class="p-3 space-y-3 text-sm " aria-labelledby="dropdownCheckboxExperience">
                        @foreach($tags->where('type', '=', 'experience') as $tag)
                            <li>
                                <div class="flex items-center">
                                    <input id="checkbox-item-1" type="checkbox" name="tags[{{$tag->name}}]" class="w-4 h-4 text-laravel border-gray-500 focus:ring-0 focus:ring-offset-0">
                                    <label for="checkbox-item-1" class="ml-2 text-sm font-medium text-gray-600">{{$tag->name}}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Technologies -->
            <div class="relative w-1/3 border border-gray-500 flex items-center justify-center">
                <a id="dropdownCheckboxButton" data-dropdown-toggle="dropdownDefaultCheckbox" class="text-gray-600 px-4 py-2.5 text-center inline-flex items-center" role="button">Technologies<i class="fa-solid fa-chevron-down ml-3"></i></a>

                <!-- Dropdown menu for technologies -->
                <div id="dropdownDefaultCheckbox" class="z-10 hidden w-full bg-white divide-y divide-gray-100 border border-gray-500 max-h-40 overflow-y-scroll">
                    <ul class="p-3 space-y-3 text-sm " aria-labelledby="dropdownCheckboxButton">
                        @foreach($tags->where('type', '=', 'technology') as $tag)
                            <li>
                                <div class="flex items-center">
                                    <input id="checkbox-item-1" type="checkbox" name="tags[{{$tag->name}}]" class="w-4 h-4 text-laravel border-gray-500 focus:ring-0 focus:ring-offset-0">
                                    <label for="checkbox-item-1" class="ml-2 text-sm font-medium text-gray-600">{{$tag->name}}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>