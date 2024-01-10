<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <title>Code Page</title>
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
                <li><a href="/register">Gérer codes </a></li>
            </ul>
            <ul>
                <li><a href="/import">Import</a></li>
            </ul>
            <ul class="bg-red-600 text-white rounded p-2">
                <li><a href="<?= site_url('code/disconnect') ?>">Déconnexion</a></li>
            </ul>
        </nav>
        <?php if ($data[0] != NULL) : ?>
            <div class="flex flex-col w-full shadow-md bg-white flex flex-col items-center rounded shadow-md p-8 w-full">
                <h1 class="my-5 text-xl">Import</h1>

                <table class="border-collapse border border-slate-500 my-5 w-full ">
                    <thead>
                        <tr>
                            <th class="border border-slate-600">id_code</th>
                            <th class="border border-slate-600">code_unique</th>
                            <th class="border border-slate-600">code_promo</th>
                            <th class="border border-slate-600">status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $d) : ?>
                            <tr>
                                <td class="border border-slate-700 "><?= $d['id_code'] ?></td>
                                <td class="border border-slate-700 "><?= $d['code_unique'] ?></td>
                                <td class="border border-slate-700 "><?= $d['code_promo'] ?></td>
                                <td class="border border-slate-700"><?= $d['status'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    </div>
    <div class="flex flex-col mt-3  items-center">
        <form action="/import" method="POST" enctype="multipart/form-data">
            <label for="csv">Import</label>
            <input name="csv" type="file">
            <button class="bg-blue-500 text-white p-2 rounded" type="submit">Envoyer</button>
        </form>
    </div>
<?php else : ?>
    <div class="flex flex-col w-full shadow-md bg-white flex flex-col items-center rounded shadow-md p-8 w-full">
        <h1 class="my-5 text-xl">Import</h1>
        <p class="text-red-500">Aucun fichier n'a été importé</p>
    <div class="flex flex-col  items-center">
        <form action="/import" method="POST" enctype="multipart/form-data">
            <label for="csv">Import</label>
            <input name="csv" type="file">
            <button class="bg-blue-500 text-white p-2 rounded" type="submit">Envoyer</button>
        </form>
    </div>
    

<?php endif; ?>



</body>

</html>