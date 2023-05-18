<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Register as:
            </h2>
        </header>

        <form action="/register/role" method="POST">
            @csrf
            @method('PUT')
            <button type="submit" class="p-5 mt-6 font-semibold text-2xl w-full text-white bg-red-500 hover:bg-red-600 rounded-lg">EMPLOYER</button>
            <br>
            <button type="submit" class="p-5 my-5 font-semibold text-2xl w-full text-white bg-red-500 hover:bg-red-600 rounded-lg">JOB SEEKER</button>
        </form>
    </x-card>
</x-layout>