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
        <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row w-full max-w-6xl shadow-lg rounded-lg overflow-hidden bg-white">

                <!-- Image -->
                <div class="w-full lg:w-1/2 bg-cover bg-center" style="background-image: url('/images/register-bg.jpeg')">
                    <div class="h-full w-full bg-black bg-opacity-20"></div>
                </div>

                <!-- Form Section -->
                <div class="w-full lg:w-1/2 p-8 md:p-12">
                    <h2 class="text-2xl text-center text-blue-600 font-semibold mb-6">Please Fill out form to Register!</h2>

                    <form method="POST" action="{{ route('register.store') }}">
                        @csrf

                        <!-- Full Name -->
                        <div class="mb-4">
                            <label for="name" class="block font-medium text-sm text-gray-700">Full name:</label>
                            <input id="name" name="name" type="text" required autofocus
                                   class="mt-1 w-11/12 border border-blue-400 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block font-medium text-sm text-gray-700">Email:</label>
                            <input id="email" name="email" type="email" required
                                   class="mt-1 w-11/12 border border-blue-400 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>


                        <div class="mb-4">
                            <label for="password" class="block font-medium text-sm text-gray-700">Password:</label>
                            <input id="password" name="password" type="password" required
                                   class="mt-1 w-11/12 border border-blue-400 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>





                        <div class="mb-4">
                            <label for="phone" class="block font-medium text-sm text-gray-700">Mobile Number:</label>
                            <input id="phone" name="phone" type="tel" required
                                   class="mt-1 w-11/12 border border-blue-400 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>


                        <div class="mb-4">
                            <label for="dob" class="block font-medium text-sm text-gray-700">Date Of Birth:</label>
                            <input id="dob" name="dob" type="date" required
                                   class="mt-1 w-11/12 border border-blue-400 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>

                        <!-- Roles -->
                        <div class="mb-6">
                            <label for="role" class="block font-medium text-sm text-gray-700">Role:</label>
                            <select id="role" name="role" required
                                    class="mt-1 w-11/12 border border-blue-400 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="User">User</option>
                            </select>
                        </div>

                        <!-- Submit -->
                        <div style="text-align: center; margin-top: 20px;">
                            <button type="submit"
                                style="background-color: blue; color: white; padding: 10px 20px; border-radius: 9999px; font-weight: bold;">
                                Sign Up
                            </button>
                        </div>


                        <!-- Social -->
                        <div class="text-center text-sm text-gray-600 mt-4">or sign up with</div>
                        <div class="flex justify-center gap-4 mt-2">
                            <button type="button" class="bg-gray-100 rounded-full p-2 shadow">
                                <img src="https://img.icons8.com/color/48/000000/google-logo.png" class="h-6 w-6" />
                            </button>
                            <button type="button" class="bg-gray-100 rounded-full p-2 shadow">
                                <img src="https://img.icons8.com/fluency/48/000000/facebook-new.png" class="h-6 w-6" />
                            </button>
                        </div>

                        <!-- Link to Login -->
                        <p class="text-center text-sm text-gray-600 mt-4">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-blue-600 font-semibold">Login</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
