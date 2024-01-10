
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Formulaire Tailwind</title>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-md mx-auto bg-white rounded-md p-8 shadow-md">
        <h2 class="text-2xl font-semibold mb-6">Mon Formulaire</h2>

        <form action="/update_user/<?=$user[0]->id?>" method="post">
            <div class="mb-4">
                <label for="password" class="block text-gray-600 text-sm font-semibold mb-2">Password :</label>
                <input type="text" value="<?=$user[0]->password?>"  id="password" name="password" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded-md focus:outline-none hover:bg-blue-600">Soumettre</button>
            </div>
        </form>
    </div>

</body>
</html>

