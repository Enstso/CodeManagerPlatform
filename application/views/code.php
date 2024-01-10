<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <title>Code Page</title>
</head>

<body class="bg-gray-100">

    <h1 class="text-6xl">Code page</h1>
    <div class="container mx-auto">
        <nav class="flex flex-row space-x-4">
            <ul>
                <li>Bienvenue!</li>
            </ul>
        </nav>
        <?php if (!empty($code_promo)) : ?>
            <p class="text-6xl">Votre code promo : <?= $code_promo ?></p>
        <?php endif; ?>
    </div>
</body>

</html>

