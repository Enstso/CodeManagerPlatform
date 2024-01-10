

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <title>Login Page</title>
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-96">

        <h1 class="text-2xl font-bold mb-4">Login</h1>

        <!-- Form -->
        <form action="/gestion" method="post">

            <!-- username Input -->
            <div class="mb-4">
                <label for="username" class="block text-gray-600 text-sm font-medium mb-2">username</label>
                <input type="text" id="username" name="username" class="w-full p-2 border border-gray-300 rounded">
            </div>

            <!-- Password Input -->
            <div class="mb-6">
                <label for="password" class="block text-gray-600 text-sm font-medium mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">Login</button>
        </form>
    </div>
</body>
</html
