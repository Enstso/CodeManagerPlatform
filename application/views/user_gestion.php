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

            <ul>
                <li><a href="/user_gestion">Gérer users</a></li>
            </ul>
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
        <div class="bg-white flex flex-col items-center rounded shadow-md p-8 w-full">
            <h1 class="my-5 text-xl">Gestion des utilisateurs</h1>
            <?php if (isset($users)) : ?>
                <table class="border-collapse border border-slate-500 my-5 w-full ">
                    <thead>
                        <tr>
                            <th class="border border-slate-600">id_user</th>
                            <th class="border border-slate-600">username</th>
                            <th class="border border-slate-600">password</th>
                            <th class="border border-slate-600">status</th>
                            <th class="border border-slate-600">update</th>
                            <th class="border border-slate-600">delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $d) : ?>

                            <tr>
                                <td class="border border-slate-700 "><?= $d->id ?></td>
                                <td class="border border-slate-700 "><?= $d->username ?></td>
                                <td class="border border-slate-700 "><?= $d->password ?></td>
                                <td class="border border-slate-700"><?= $d->status ?></td>
                                <td class="border border-slate-700"><a href="<?= site_url('/update_user/' . $d->id) ?>">🔁</a></td>
                                <td class="border border-slate-700"><a href="<?= site_url('/delete_user/' . $d->id) ?>">🗑️</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            <a class=" bg-blue-500 text-white  p-2 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800" href="/create_user">Créer un utilisateur</a>
        </div>
    </div>
</body>

</html>

