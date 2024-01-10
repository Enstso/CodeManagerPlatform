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
            <ul class="bg-red-600 hover:bg-red-700 text-white rounded p-2">
                <li><a href="<?= site_url('code/disconnect') ?>">Déconnexion</a></li>
            </ul>
        </nav>
        <div class="w-full">

            <div class=" p-8 rounded shadow-md">
                <h1 class="text-2xl font-semibold mb-6">Recherche avancée</h1>

                <form method="POST" action="/gestion">
                    <!-- Champ 1 -->
                    <div class="mb-4">
                        <label for="code_unique" class="block text-gray-700 text-sm font-bold mb-2">code_unique</label>
                        <select name="code_unique" id="" class="w-full px-3 py-2 border rounded-md">
                            <option value="">codes_uniques</option>
                            <?php foreach ($codes_uniques as $d) : ?>
                                <option value="<?= $d->code_unique ?>"><?= $d->code_unique ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <!-- Champ 3 -->
                    <div class="mb-6">
                        <select name="status" id="status">
                            <option value="">Choix</option>
                            <option value="1">Utilisé</option>
                            <option value="2">Inutilisé</option>
                        </select>
                    </div>

                    <!-- Bouton Soumettre -->
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Soumettre</button>
                </form>
                <button type="submit" class=" mt-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"> <a href="/export_partial">Export</a> </button>

            </div>

            <?php if (isset($codes)) : ?>
                <div class="flex flex-col w-full shadow-md bg-white flex flex-col items-center rounded shadow-md p-8 w-full">
                    <h1 class="my-5 text-xl">Les codes</h1>
                    <table class="border-collapse border border-slate-500 my-5 w-full   shadow-md mt-5">
                        <thead>
                            <tr>
                                <th class="border border-slate-600">code_unique</th>
                                <th class="border border-slate-600">status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($codes as $d) : ?>
                                <tr>
                                    <td class="border border-slate-700 "><?= $d->code_unique ?></td>
                                    <td class="border border-slate-700"><?= $d->status ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            <?php if (isset($paginate)) : ?>
                <div class="center"> <?php echo $paginate ?></div>
            <? endif; ?>
        </div>
    </div>
</body>

</html>