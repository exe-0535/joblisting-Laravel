<x-layout>
@include('partials._search')

<a href="/" class="inline-block text-black ml-4 mb-4"
                ><i class="fa-solid fa-arrow-left"></i> Back
            </a>
            <div class="mx-4">
                <x-card class="p-10">
                    <div
                        class="flex flex-col items-center justify-center text-center"
                    >
                        <img
                            class="w-48 mr-6 mb-6"
                            src="{{$listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png')}}"
                            alt=""
                        />

                        <h3 class="text-2xl mb-2">{{$listing->title}}</h3>
                        <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
                        
                        <x-listing-tags :tagsCsv="$listing->tags"/>

                        <div class="text-lg my-4">
                            <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
                        </div>
                        <div class="border border-gray-200 w-full mb-6"></div>
                        <div>
                            <h3 class="text-3xl font-bold mb-4">
                                Job Description
                            </h3>
                            <div class="text-lg space-y-6">
                                {{$listing->description}}

                                <a
                                    href="mailto:{{$listing->email}}"
                                    class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"
                                    ><i class="fa-solid fa-envelope"></i>
                                    Contact Employer</a
                                >

                                <a
                                    href="{{$listing->website}}"
                                    target="_blank"
                                    class="block bg-black text-white py-2 rounded-xl hover:opacity-80"
                                    ><i class="fa-solid fa-globe"></i> Visit
                                    Website</a
                                >
                            </div>
                        </div>
                    </div>
                </x-card>

                @can('edit gigs')
                    @if ($listing->user_id == auth()->user()->id)
                        <x-card class="mt-4 p-2 flex space-x-6 items-center justify-center">
                            <a href="/listings/{{$listing->id}}/edit">
                                <i class="fa-solid fa-pencil"></i> Edit
                            </a>

                            <form action="/listings/{{$listing->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
                            </form>
                        </x-card>
                    @endif
                @endcan

                @can('create applications')
                <x-card class="mt-4 p-2 flex space-x-6 items-center justify-center">
                    <div class="w-1/2">
                        <h3 class="text-2xl font-bold mb-4 text-center">
                            Apply for this job
                        </h3>
                        <form action="{{url('/applications/' . $listing->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="my-3 w-full">
                                <label for="note" class="inline-block text-base mb-2 font-bold">Introduce yourself</label>

                                <textarea
                                    type="text"
                                    class="border border-gray-200 resize-none rounded-md w-full pb-5 max-h-15"
                                    name="note"
                                    value="{{old('note')}}"
                                    placeholder="Introduce yourself, paste your github or linkedin links, etc."></textarea>

                                @error('note')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="my-3 w-full">
                                <label for="note" class="inline-block text-base mb-2 font-bold">CV Upload</label>

                                <input
                                    type="file"
                                    class="w-full"
                                    name="cv"
                                    value="{{old('cv')}}"
                                />
                                @error('cv')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="my-5">
                                <button type="submit" class="bg-laravel text-white rounded py-3 px-4 hover:bg-black w-full">
                                    Apply
                                </button>
                            </div>
                        </form>
                    </div>
                </x-card>

                @endcan
            </div>

</x-layout>