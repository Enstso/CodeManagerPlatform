
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <title>Register Page</title>
</head>

<body class="bg-gray-100">
    <div class="flex flex-row space-x-2 space-y-2 ">
    <nav class="flex flex-col space-y-2 p-8 items-center">
                <ul>
                    <li><a href="/">Home</a></li>
                </ul>

                <ul>
                    <li><a href="/gestion">Gestion</a></li>
                </ul>
                <?php if (isset($_SESSION['admin'])) : ?>
                    <ul>
                        <li><a href="/user_gestion">Gérer users</a></li>
                    </ul>
                <?php endif; ?>
                <ul>
                    <li><a href="/register">Gérer  codes </a></li>
                </ul>
                <ul>
                    <li><a href="/import">Import</a></li>
                </ul>
                <ul class="bg-red-600 text-white rounded p-2">
                    <li ><a  href="<?= site_url('code/disconnect') ?>">Déconnexion</a></li>
                </ul>
            </nav>
        <div class=" bg-white p-6 rounded shadow-md w-full">

            <h1 class="text-2xl font-bold mb-4">Générer vos codes uniques</h1>

            <!-- Form -->
            <form action="/export" method="post">
                <input name="operation"  type="text" class="block p-3 text-gray-600 border rounded border-gray-300 text-sm font-semibold w-full mb-2" placeholder="nombre d'opération">
                <input type="hidden" value="1">
                <!-- Submit Button -->
                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">Créer des codes</button>

            </form>

        </div>
    </div>
</body>

</html>
