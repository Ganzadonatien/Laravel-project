<x-guest-layout>
    <div class="min-h-screen bg-gray-100">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
                <div class="text-xl font-semibold text-gray-800">Alcohol Detector Device</div>
                <nav class="space-x-8 text-sm">
                    <a href="{{ url('/') }}" class="font-semibold text-black border-b-2 border-black">Home</a>
                    <a href="#" class="text-gray-600 hover:text-black">Products</a>
                    <a href="#" class="text-gray-600 hover:text-black">Contacts</a>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <div class="flex items-center justify-center py-12">
            <div class="flex w-full max-w-4xl shadow-lg rounded-lg overflow-hidden bg-white">

                <!-- Left Image Panel -->
                <div class="w-1/2 bg-cover bg-center" style="background-image: url('/images/register-bg.jpeg')"></div>

                <!-- Login Form -->
                <div class="w-1/2 p-8">
                    <h2 class="text-xl text-center text-blue-600 font-semibold mb-6">Welcome Back</h2>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block font-semibold text-sm text-gray-700">Email</label>
                            <input id="email" name="email" type="email" required autofocus
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block font-semibold text-sm text-gray-400">Password</label>
                            <input id="password" name="password" type="password" required
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between mb-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="remember" class="mr-2">
                                <span class="text-sm text-gray-600">Remember me</span>
                            </label>
                            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Forgot Password?</a>
                        </div>

                        <!-- Submit -->
                        <div style="text-align: center; margin-top: 20px;">
                            <button type="submit"
                                style="background-color: blue; color: white; padding: 10px 20px; border-radius: 5px; font-weight: bold;">
                                Log In
                            </button>
                        </div>

                        <!-- Social Login (Optional) -->
                        <div class="text-center text-sm text-gray-600 mt-4">or log in with</div>
                        <div class="flex justify-center gap-4 mt-2">
                            <button type="button" class="bg-gray-100 rounded-full p-2 shadow">
                                <img src="https://img.icons8.com/color/48/000000/google-logo.png" class="h-6 w-6" />
                            </button>
                            <button type="button" class="bg-gray-100 rounded-full p-2 shadow">
                                <img src="https://img.icons8.com/fluency/48/000000/facebook-new.png" class="h-6 w-6" />
                            </button>
                        </div>

                        <!-- Sign Up -->
                        <p class="text-center text-sm text-gray-600 mt-4">
                            Don’t have an account?
                            <a href="{{ route('register') }}" class="text-blue-600 font-semibold">Sign Up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

