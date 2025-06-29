<?php
// Sanitize POST data
$score = isset($_POST['score']) ? (int)$_POST['score'] : 0;
$total = isset($_POST['total']) ? (int)$_POST['total'] : 0;

$percentage = ($total > 0) ? round(($score / $total) * 100) : 0;

$message = "Votre formation continue est la clé de la sécurité des patients.";
if ($percentage >= 80) {
    $message = "Excellent travail ! Vous avez une très bonne connaissance des critères d'intubation difficile.";
} elseif ($percentage >= 50) {
    $message = "Bon score ! Continuez à vous exercer pour maîtriser tous les critères.";
} else {
    $message = "Il y a encore une marge de progression. N'hésitez pas à refaire le test et à consulter les recommandations.";
}

$title = 'Résultats - Serious Game';
include 'partials/header.php';
?>

<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg text-center">
    <h1 class="text-4xl font-bold text-blue-600 mb-4">Fin de la simulation</h1>
    
    <div class="my-6">
        <h2 class="text-2xl font-semibold text-gray-800">Votre score final est de :</h2>
        <p class="text-6xl font-bold my-4 text-blue-600">
            <?php echo $score; ?> / <?php echo $total; ?>
        </p>
        <p class="text-xl text-gray-600">(Soit <?php echo $percentage; ?>% de bonnes réponses)</p>
    </div>

    <p class="text-lg italic text-gray-700 border-t pt-6">
        "<?php echo $message; ?>"
    </p>

    <div class="mt-8">
        <a href="index.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300">
            Rejouer
        </a>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
