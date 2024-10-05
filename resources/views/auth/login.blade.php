<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-4 text-center">Login</h2>

        @if ($errors->any())
            <div class="text-red-500 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block mb-1">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full border border-gray-300 p-2 rounded-md">
            </div>
            <div class="mb-4">
                <label for="password" class="block mb-1">Password:</label>
                <input type="password" id="password" name="password" required class="w-full border border-gray-300 p-2 rounded-md">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300">Login</button>
        </form>

        <p class="mt-4 text-center">Don't have an account? <a href="{{ route('register') }}" class="text-blue-500">Register here</a></p>
    </div>

</body>
</html>