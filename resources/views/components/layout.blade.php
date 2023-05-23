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
                    {{-- @hasrole('seeker')
                    <li>
                        <span class="font-bold uppercase">
                            Hi, {{auth()->user()->name}}, you're a seeker!
                        </span>
                    </li>
                    @else
                    <li>
                        <span class="font-bold uppercase">
                            Hi, {{auth()->user()->name}}, you're a employer!
                        </span>
                    </li>
                    @endhasrole --}}
                    <li>
                        
                        {{-- <button type="button" class="relative inline-flex items-center p-3 text-sm font-medium text-center text-white bg-transparent rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                            <span class="sr-only">Notifications</span>
                            <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900">20</div>
                        </button> --}}
                        <a href="#" class="relative inline-flex items-center text-base font-medium text-center text-black rounded-lg focus:ring-4 focus:outline-none">
                            <i class="hover:text-laravel fa-solid fa-bell"></i>
                            <div class="absolute inline-flex items-center justify-center w-4 h-4 text-[10px] font-bold text-white bg-laravel rounded-full -top-2 -right-2">{{auth()->user()->notifications->count()}}</div>
                        </a>
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
</body>
</html>