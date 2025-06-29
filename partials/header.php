<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Serious Game Anesthésie-Réa'; ?></title>
    <!-- TailwindCSS from CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js from CDN -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Simple transition for a smoother feel */
        [x-cloak] { display: none !important; }
        .fade-enter-active, .fade-leave-active { transition: opacity .5s; }
        .fade-enter, .fade-leave-to { opacity: 0; }
    </style>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🫁</text></svg>">
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
    <div class="container mx-auto p-4 md:p-8">
