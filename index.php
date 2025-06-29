<?php
$title = 'Consultation Pré-Anesthésique - Serious Game';
include 'partials/header.php';
?>

<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-blue-600 mb-2">Serious Game : Consultation Pré-Anesthésique</h1>
        <strong>Dr Samia Arfaoui, Résident Iheb Chagra</strong>
        <p class="text-lg text-gray-600">Bonjour Docteur. Votre journée de consultation commence.</p>
    </div>

    <div class="text-left border-t pt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">Votre Mission</h2>
        <p class="mb-4">
            Votre rôle est crucial : évaluer chaque patient pour <strong>anticiper et préparer la gestion des voies aériennes</strong>. Une bonne évaluation préopératoire est la clé de la sécurité du patient.
        </p>
        <ul class="list-disc list-inside mb-6 space-y-2 bg-gray-50 p-4 rounded-md">
            <li>Pour chaque patient, vous accéderez à des éléments d'examen clinique (photos).</li>
            <li>Observez attentivement pour identifier les <strong>critères d'intubation et/ou de ventilation au masque difficile</strong>.</li>
            <li>Posez votre diagnostic en sélectionnant la ou les réponses qui vous semblent pertinentes.</li>
            <li>Votre acuité diagnostique sera évaluée à la fin de vos consultations.</li>
        </ul>
    </div>

    <div class="mt-10 text-center">
        <a href="quiz.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105">
            Commencer la Consultation
        </a>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
