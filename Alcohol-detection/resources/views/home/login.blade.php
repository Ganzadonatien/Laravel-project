<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-lg overflow-hidden max-w-4xl w-full">

            <!-- Login Form -->
            <div class="w-full md:w-1/2 p-8">
                <h2 class="text-2xl font-semibold text-center text-blue-600 mb-6">Welcome Back!</h2>

                <form method="POST" action="{{ route('home') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" required
                            class="mt-1 block w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm" />
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" required
                            class="mt-1 block w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm" />
                    </div>

                    <!-- Submit -->
                    <div class="text-center">
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow">
                            Login
                        </button>
                    </div>
                </form>

                <!-- Register Link -->
                <p class="text-center text-sm text-gray-600 mt-4">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Register</a>
                </p>
            </div>

            <!-- Image -->
            <div class="hidden md:block md:w-1/2 bg-cover bg-center"
                style="background-image: url('/images/login-illustration.png');">
            </div>
        </div>
    </div>
</x-guest-layout>
