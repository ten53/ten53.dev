<x-layout title="Login">
    <form action="{{ route('login') }}" method="POST" class="flex justify-center items-center mx-auto mt-10">
        @csrf
        <fieldset class="fieldset border-base-300 rounded-box w-xs border p-4 bg-base-300">
            <legend class="fieldset-legend">Login</legend>

            <div>
                <label class="label" for="email">Email</label>
                <input type="email" name="email" id="password" class="input" placeholder="Email" required/>
            </div>

            <div class="mt-4">
                <label class="label" for="password">Password</label>
                <input type="password" name="password" id="password" class="input" placeholder="Password" required/>
            </div>

            <button class="btn btn-neutral mt-4 w-full">Login</button>
        </fieldset>
    </form>
</x-layout>
