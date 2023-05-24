<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="images/favicon.ico" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "#ef3b2d",
                        },
                    },
                },
            };
        </script>
        <title>LaraGigs | Best IT Listings Service</title>
    </head>
    <body class="mb-48">
        <nav class="flex justify-between items-center mb-4">
            <a href="/"
                ><img class="w-24" src="{{asset('images/logo.png')}}" alt="" class="logo"
            /></a>
            <ul class="flex space-x-6 mr-6 text-lg">
                @auth
                    <li>
                            <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification" class="relative inline-flex items-center text-base font-medium text-center text-black rounded-lg focus:outline-none" type="button">
                                <i class="hover:text-laravel fa-solid fa-bell"></i>
                                <div class="absolute inline-flex items-center justify-center w-4 h-4 text-[10px] font-bold text-white bg-laravel rounded-full -top-2 -right-2">{{auth()->user()->notifications->count()}}</div>
                            </button>
                        
                            <!-- Dropdown menu -->
                            <div id="dropdownNotification" class="z-20 hidden w-full max-w-xs bg-gray-50 divide-y divide-gray-100 rounded-lg shadow border-solid border border-gray-500" aria-labelledby="dropdownNotificationButton">
                                <div class="block px-4 py-2 font-medium text-center rounded-t-lg bg-gray-50">
                                    Notifications
                                </div>
                                @foreach(auth()->user()->notifications as $notification)
                                    <div class="divide-y divide-gray-100 dark:divide-gray-700">
                                        @hasrole('employer')
                                        <div class="my-3 px-4">
                                            <div class="text-lg mb-1 w-full">
                                                {{auth()->user()->listings->where('id', '=', $notification->data['listing_id'])->first()->title}}
                                            </div>
                                            <div class="font-bold text-base">
                                                @php
                                                    $listing = auth()->user()->listings->where('id', '=', $notification->data['listing_id'])->first();
                                                    $application = $listing->applications()->where('user_id', '=', $notification->data['user_id'])->first();
                                                    $user = $application->user;
                                                    $fullName = $user->name . ' ' . $user->surname;
                                                @endphp

                                                {{ $fullName }}
                                            </div>
                                        </div>
                                        @endhasrole
                                    </div>
                                @endforeach
                                {{-- <a href="#" class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
                                    <div class="inline-flex items-center ">
                                    <svg class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                                        View all
                                    </div>
                                </a> --}}
                            </div>
                            
                    </li>


                    @hasrole('employer')
                    
                        <li>
                            <a href="/listings/manage" class="hover:text-laravel">
                                <i class="fa-solid fa-gear"></i> Manage listings
                            </a>
                        </li>

                    @endhasrole

                    @hasrole('seeker')

                        <li>
                            <a href="/applications/show" class="hover:text-laravel">
                                <i class="fa-solid fa-gear"></i> My job applications
                            </a>
                        </li>

                    @endhasrole
                    <li>
                        <form action="/logout" method="POST" class="inline">
                            @csrf
                            <button type="submit">
                                <i class="fa-solid fa-door-closed"></i> Logout
                            </button>
                    
                        </form>
                    </li>
                @else
                    <li>
                        <a href="/register/role" class="hover:text-laravel">
                            <i class="fa-solid fa-user-plus"></i> Register
                        </a>
                    </li>
                    <li>
                        <a href="/login" class="hover:text-laravel">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </nav>

        <main>
            {{$slot}}
        </main>

        <footer
        class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center"
    >
        <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>

        @hasrole('employer')
            <a href="/listings/create" class="absolute top-1/3 right-10 bg-black text-white py-2 px-5">
                Post Job
            </a>
        @endhasrole
    </footer>

    <!-- It doesn't matter where I put flash message since it has postion fixed on it -->
    <x-flash-message/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>