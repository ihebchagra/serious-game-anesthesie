<?php
// Sanitize POST data
$score = isset($_POST['score']) ? (int)$_POST['score'] : 0;
$total = isset($_POST['total']) ? (int)$_POST['total'] : 0;
// Get the type of quiz that was just completed
$quiz_type = isset($_POST['quiz_type']) ? $_POST['quiz_type'] : '';

$percentage = ($total > 0) ? round(($score / $total) * 100) : 0;

// --- MODIFICATION: Set up dynamic content based on quiz type ---
$next_quiz_url = 'diapo.php'; // Default fallback link
$continue_button_text = 'Unlock the Knowledge';
$continue_button_class = 'bg-blue-500 hover:bg-blue-700';

if ($quiz_type === 'standard' || $quiz_type === 'standard_with_correction') {
    $title = 'Résultats - Évaluation';
    $main_heading = "Fin de la partie d'images";
    $message = "Vous avez terminé la première partie. Préparez-vous pour les cas cliniques.";
    
    // Determine the next quiz URL based on the mode just played
    $next_quiz_url = ($quiz_type === 'standard') ? 'quiz.php?type=cas' : 'quiz.php?type=cas_with_correction';
    $continue_button_text = 'Continuer';
    $continue_button_class = 'bg-green-600 hover:bg-green-800';

} elseif ($quiz_type === 'cas' || $quiz_type === 'cas_with_correction') {
    $title = 'Résultats - Cas Cliniques';
    $main_heading = "Fin des cas cliniques";
    $message = "Excellent travail, vous avez terminé la simulation !";
    // Defaults for button and URL are already correct for the final page

} else {
    // Fallback for any other case
    $title = 'Résultats';
    $main_heading = 'Fin du Quiz';
    $message = "Votre formation continue est la clé de la sécurité des patients.";
}

// Add (avec correction) to title if applicable
if ($quiz_type === 'standard_with_correction' || $quiz_type === 'cas_with_correction') {
    $title .= ' (avec correction)';
}


include 'partials/header.php';
?>

<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg text-center">
    <h1 class="text-4xl font-bold text-blue-600 mb-4"><?php echo htmlspecialchars($main_heading); ?></h1>
    
    <div class="my-6">
        <h2 class="text-2xl font-semibold text-gray-800">Votre score pour cette partie :</h2>
        <p class="text-6xl font-bold my-4 text-blue-600">
            <?php echo $score; ?> / <?php echo $total; ?>
        </p>
        <p class="text-xl text-gray-600">(Soit <?php echo $percentage; ?>% de bonnes réponses)</p>
    </div>

    <p class="text-lg italic text-gray-700 border-t pt-6">
        "<?php echo htmlspecialchars($message); ?>"
    </p>

    <!-- --- MODIFICATION: Dynamic button using variables set above --- -->
    <div class="mt-8">
        <a href="<?php echo $next_quiz_url; ?>" class="<?php echo $continue_button_class; ?> text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300">
            <?php echo htmlspecialchars($continue_button_text); ?>
        </a>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
