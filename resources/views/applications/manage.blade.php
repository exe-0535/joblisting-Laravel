<x-layout>

    <x-card class="p-10">
        <header>
            <div
                class="text-3xl text-center mt-6 mb-12 uppercase"
            >
                Applications for <p class="font-bold">{{$listing->title}}</p>
            </div>
        </header>

        <div class="w-full">
            <table class="table-auto rounded-sm break-words">
                <tbody>
                    @unless($applications->isEmpty())
                        @foreach ($applications as $application)
                            <tr class="border-gray-300">
                                <div class="m-5 p-5 border-solid border-4 border-laravel rounded-lg bg-[#ffe0de]">
                                    <div class="mb-5 font-bold text-lg">
                                        {{$application->user->name . ' ' . $application->user->surname}}
                                    </div>
                                    <div class="mb-5 break-words">
                                        {{$application->note}}
                                    </div>
                                    <div class="mb-5 break-words">
                                        <i class="fa-sharp fa-solid fa-download text-laravel"></i> <a class="text-laravel font-bold hover:text-black" href="{{route('download', ['cv' => substr($application->cv, 4)])}}" download="cv" target="_blank">Download CV</a>
                                    </div>
                                    <div class="mb-5 break-words">
                                        <button onclick="{{$application->status = 'accepted'}}" class="py-2 px-10 mt-3 mr-10 font-semibold text-base text-white bg-green-500 hover:bg-green-800 rounded-full border-solid border-2 border-black">
                                            ACCEPT
                                        </button>
                                        <button onclick="{{$application->status = 'declined'}}" class="py-2 px-10 mt-3 font-semibold text-base text-white bg-red-500 hover:bg-red-800 rounded-full border-solid border-2 border-black">
                                            DECLINE
                                        </button>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    @else
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <p class="text-center">No applications found (yet!)</p>
                            </td>
                        </tr>
                    @endunless
                </tbody>
            </table>
        </div>
        
    </x-card>

</x-layout>