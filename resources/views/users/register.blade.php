<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Register
                @if ($role === 'seeker')
                    as a job seeker
                @else 
                    as an employer
                @endif
            </h2>
            <p class="mb-4">
                @if ($role === 'employer')
                    Start looking for employees!
                @else 
                    Start looking for IT jobs!
                @endif
            </p>
        </header>

        <form action="/users/{{$role}}" method="POST">
            @csrf


            {{-- Company name (for employees only) --}}

            @if ($role === 'employer')
                <div class="mb-3">
                    <label for="company_name" class="inline-block text-sm mb-2">
                        Company Name
                    </label>
                    <input
                        type="text"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="company_name"
                        value="{{old('company_name')}}"
                    />
                    @error('company_name')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>                
            @endif

            <div class="mb-3">
                <label for="name" class="inline-block text-sm mb-2">
                    First Name
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="name"
                    value="{{old('name')}}"
                />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="surname" class="inline-block text-sm mb-2">
                    Surname
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="surname"
                    value="{{old('surname')}}"
                />
                @error('surname')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="inline-block text-sm mb-2"
                    >E-mail address</label
                >
                <input
                    type="email"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="email"
                    value="{{old('email')}}"
                />
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            {{-- Phone number (for employers only) --}}

            @if ($role === 'employer')
                <div class="mb-3">
                    <label for="phone_number" class="inline-block text-sm mb-2">
                        Phone number
                    </label>
                    <input
                        type="tel"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="phone_number"
                        value="{{old('phone_number')}}"
                    />
                    @error('phone_number')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>                
            @endif

            <div class="mb-3">
                <label
                    for="password"
                    class="inline-block text-sm mb-2"
                >
                    Password
                </label>
                <input
                    type="password"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="password"
                />
                @error('password')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            
            <div class="mb-3">
                <label
                    for="password2"
                    class="inline-block text-sm mb-2"
                >
                    Confirm Password
                </label>
                <input
                    type="password"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="password_confirmation"
                />
                @error('password_confirmation')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="my-5">
                <button
                    type="submit"
                    class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Sign Up
                </button>
            </div>

            <div class="mt-3">
                <p>
                    Already have an account?
                    <a href="/login" class="text-laravel">Log in</a>
                </p>
            </div>
        </form>
    </x-card>
</x-layout>