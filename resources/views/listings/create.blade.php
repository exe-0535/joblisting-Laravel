<x-layout>

<x-card class='p-10  max-w-lg mx-auto mt-24'
>
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Create a Gig
        </h2>
        <p class="mb-4">Post a gig to find a developer</p>
    </header>

    <form action="/listings" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-6">
            <label
                for="company"
                class="inline-block text-lg mb-2"
                >Company Name</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="company"
                value="{{old('company')}}"
            />
            
            @error('company')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="title" class="inline-block text-lg mb-2"
                >Job Title</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="title"
                placeholder="Example: Senior Laravel Developer"
                value="{{old('title')}}"
            />
            @error('title')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label
                for="location"
                class="inline-block text-lg mb-2"
                >Job Location</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="location"
                placeholder="Example: Remote, Boston MA, etc"
                value="{{old('location')}}"
            />
            @error('location')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="email" class="inline-block text-lg mb-2"
                >Contact Email</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="email"
                value="{{old('email')}}"
            />
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label
                for="website"
                class="inline-block text-lg mb-2"
            >
                Website/Application URL
            </label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="website"
                value="{{old('website')}}"
            />
            @error('website')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="flex w-full @if($errors->has('tags') || $errors->has('tags.technologies') || $errors->has('tags.experience') || $errors->has('tags.categories')) mb-0 @else mb-6 @endif">
            <!-- Categories -->
            <div class="relative w-1/3 mr-4 border border-gray-500 flex items-center justify-center">
                <a id="dropdownCheckboxCategories" data-dropdown-toggle="dropdownCategories" class="text-gray-600 px-4 py-2.5 text-center inline-flex items-center" role="button">Categories<i class="fa-solid fa-chevron-down ml-3"></i></a>

                <!-- Dropdown menu for categories -->
                <div id="dropdownCategories" class="z-10 hidden w-full bg-white divide-y divide-gray-100 border border-gray-500 max-h-40 overflow-y-scroll">
                    <ul class="p-3 space-y-3 text-sm " aria-labelledby="dropdownCheckboxCategories">
                        @foreach($tags->where('type', '=', 'category') as $tag)
                            <li>
                                <div class="flex items-center">
                                    <input class="w-4 h-4 text-laravel border-gray-500 focus:ring-0 focus:ring-offset-0" name="tags[categories][{{strtolower($tag->name)}}]" id="checkbox-item-1" type="checkbox" value={{old('tags[categories][' . strtolower($tag->name) . ']')}}>
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
                                    <input class="w-4 h-4 text-laravel border-gray-500 focus:ring-0 focus:ring-offset-0" id="checkbox-item-1" name="tags[experience][{{strtolower($tag->name)}}]" type="checkbox" value={{old('tags[experience][' . strtolower($tag->name) . ']')}}>
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
                                    <input class="w-4 h-4 text-laravel border-gray-500 focus:ring-0 focus:ring-offset-0" id="checkbox-item-1" name="tags[technologies][{{strtolower($tag->name)}}]" type="checkbox" value={{old('tags[technologies][' . strtolower($tag->name) . ']')}}>
                                    <label for="checkbox-item-1" class="ml-2 text-sm font-medium text-gray-600">{{$tag->name}}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="mb-6">
            @error('tags')
                <p class="text-red-500 text-xs mt-1">You need to pick at least 1 tag in every category</p>
            @enderror
            @if(!$errors->has('tags')) 
            @error('tags.technologies')
                <p class="text-red-500 text-xs mt-1">You need to include at least 1 technology</p>
            @enderror
            @error('tags.experience')
                <p class="text-red-500 text-xs mt-1">You need to include at least 1 experience level</p>
            @enderror
            @error('tags.categories')
                <p class="text-red-500 text-xs mt-1">You need to include at least 1 category</p>
            @enderror
            @endif
        </div>

        <div class="mb-6">
            <label for="logo" class="inline-block text-lg mb-2">
                Company Logo
            </label>
            <input
                type="file"
                class="rounded p-2 w-full"
                name="logo"
                value="{{old('logo')}}"
            />
            @error('logo')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label
                for="description"
                class="inline-block text-lg mb-2"
            >
                Job Description
            </label>
            <textarea
                class="border border-gray-200 rounded p-2 w-full"
                name="description"
                rows="10"
                placeholder="Include tasks, requirements, salary, etc"
            >{{old('description')}}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <button
                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
            >
                Create Gig
            </button>

            <a href="/" class="text-black ml-4"> Back </a>
        </div>
    </form>
</x-card>
</x-layout>