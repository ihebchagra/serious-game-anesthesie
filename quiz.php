<?php

// --- MODIFICATION START ---

// Determine which quiz to load based on URL parameter
$quiz_type = $_GET['type'] ?? '';
$filepath = '';
$title = '';
$is_correction_mode = false; // Flag for the new modes

if ($quiz_type === 'standard') {
    $filepath = 'questions.csv';
    $title = 'Quiz - Évaluation du patient';
} elseif ($quiz_type === 'cas') {
    $filepath = 'cas.csv';
    $title = 'Quiz - Cas Cliniques';
} elseif ($quiz_type === 'standard_with_correction') {
    $filepath = 'questions.csv';
    $title = 'Quiz - Évaluation (avec correction)';
    $is_correction_mode = true;
} elseif ($quiz_type === 'cas_with_correction') {
    $filepath = 'cas.csv';
    $title = 'Quiz - Cas Cliniques (avec correction)';
    $is_correction_mode = true;
} else {
    // If no valid type is provided, redirect to the start
    header('Location: index.php');
    exit();
}

function parse_questions_csv($filepath) {
    $questions = [];
    if (file_exists($filepath) && ($handle = fopen($filepath, "r")) !== FALSE) {
        $header = fgetcsv($handle, 1000, ",");
        if ($header === null) {
            fclose($handle);
            return [];
        }
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if (count($data) == count($header)) {
                 $questions[] = array_combine($header, $data);
            }
        }
        fclose($handle);
    }
    return $questions;
}

$questions = parse_questions_csv($filepath);
$questions_json = json_encode($questions);

// --- MODIFICATION END ---

include 'partials/header.php';
?>

<!-- Pass the is_correction_mode flag to the Alpine component -->
<div x-data="quizGame(<?php echo htmlspecialchars($questions_json, ENT_QUOTES, 'UTF-8'); ?>, <?php echo $is_correction_mode ? 'true' : 'false'; ?>)" x-init="init()" x-cloak>
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-blue-600">Question <span x-text="currentQuestionIndex + 1"></span> / <span x-text="questions.length"></span></h2>
            <p class="text-lg font-semibold">Score: <span x-text="score" class="text-cyan-600"></span></p>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-4 mb-6">
            <div class="bg-blue-500 h-4 rounded-full transition-all duration-500" :style="`width: ${progress}%`"></div>
        </div>

        <!-- Question Area -->
        <div v-if="currentQuestion">
            <p class="text-xl font-semibold mb-4 text-center" x-text="currentQuestion.question_text"></p>
            <div class="flex justify-center items-center mb-6">
                <template x-if="currentQuestion.image_paths">
                    <img :src="currentQuestion.image_paths" alt="Cas clinique" class="max-w-xs md:max-w-sm rounded-lg shadow-md border">
                </template>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <template x-for="(choice, index) in shuffledChoices" :key="index">
                    <!-- MODIFICATION: Button class is now determined by a helper function for more complex logic -->
                    <button @click="toggleAnswer(choice.originalIndex)"
                            :disabled="isLocked"
                            :class="getChoiceClass(choice)"
                            class="p-4 rounded-lg text-left w-full transition duration-200 disabled:cursor-not-allowed">
                        <span class="font-semibold" x-text="choice.text"></span>
                    </button>
                </template>
            </div>
            <div class="text-center mt-6">
                <template x-if="!isLocked">
                    <button @click="validateAnswer" :disabled="selectedAnswers.length === 0" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-3 px-8 rounded-full text-lg disabled:bg-gray-400 disabled:cursor-not-allowed">
                        Valider la réponse
                    </button>
                </template>
                <div x-show="isLocked" x-transition.opacity>
                    <!-- MODIFICATION: The old feedback is now conditional and only shows for non-correction modes -->
                    <template x-if="!isCorrectionMode">
                        <div x-show="feedback === 'correct'" class="p-4 rounded-lg bg-green-100 border border-green-400">
                            <h3 class="font-bold text-green-800 text-xl">Correct !</h3>
                            <p class="text-green-700">Bonne décision. Le patient reste stable.</p>
                            <img src="assets/images/correct_saturation.webp?v=1" alt="Saturation correcte" class="mx-auto mt-2 max-h-96">
                        </div>
                        <div x-show="feedback === 'incorrect'" class="p-4 rounded-lg bg-red-100 border border-red-400">
                            <h3 class="font-bold text-red-800 text-xl">Incorrect.</h3>
                            <p class="text-red-700">Ce n'était pas la bonne réponse. Le patient désature !</p>
                            <img src="assets/images/desaturation.webp" alt="Désaturation" class="mx-auto mt-2 max-h-96">
                        </div>
                    </template>
                    <button @click="nextQuestion" class="mt-4 bg-gray-700 hover:bg-gray-900 text-white font-bold py-3 px-8 rounded-full text-lg">
                        <span x-show="currentQuestionIndex < questions.length - 1">Question Suivante →</span>
                        <span x-show="currentQuestionIndex >= questions.length - 1">Voir les résultats</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <form x-ref="conclusionForm" action="conclusion.php" method="POST" class="hidden">
        <input type="hidden" name="score" :value="score">
        <input type="hidden" name="total" :value="questions.length">
        <input type="hidden" name="quiz_type" value="<?php echo htmlspecialchars($quiz_type); ?>">
    </form>

</div>

<!-- MODIFICATION: Alpine.js script updated for new modes -->
<script>
    function quizGame(questionsData, isCorrectionMode) {
        return {
            questions: questionsData,
            isCorrectionMode: isCorrectionMode,
            currentQuestionIndex: 0,
            score: 0,
            selectedAnswers: [],
            isLocked: false,
            feedback: null,
            shuffledChoices: [],
            init() { this.shuffleCurrentQuestion(); },
            get currentQuestion() { return this.questions[this.currentQuestionIndex]; },
            get progress() {
                if (this.questions.length === 0) return 0;
                return ((this.currentQuestionIndex + 1) / this.questions.length) * 100;
            },
            shuffleCurrentQuestion() {
                if (!this.currentQuestion) return;
                const choices = this.currentQuestion.choices.split('|');
                let choicesWithOriginalIndex = choices.map((choiceText, originalIndex) => ({ text: choiceText, originalIndex: originalIndex.toString() }));
                for (let i = choicesWithOriginalIndex.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [choicesWithOriginalIndex[i], choicesWithOriginalIndex[j]] = [choicesWithOriginalIndex[j], choicesWithOriginalIndex[i]];
                }
                this.shuffledChoices = choicesWithOriginalIndex;
            },
            toggleAnswer(originalChoiceIndex) {
                if (this.isLocked) return;
                const choiceStr = originalChoiceIndex.toString();
                if (this.currentQuestion.type === 'single') {
                    this.selectedAnswers = [choiceStr];
                } else {
                    if (this.selectedAnswers.includes(choiceStr)) {
                        this.selectedAnswers = this.selectedAnswers.filter(ans => ans !== choiceStr);
                    } else {
                        this.selectedAnswers.push(choiceStr);
                    }
                }
            },
            validateAnswer() {
                if (this.selectedAnswers.length === 0) return;
                this.isLocked = true;
                const correct = this.currentQuestion.correct_answers.split('|').sort();
                const selected = [...this.selectedAnswers].sort();
                if (JSON.stringify(correct) === JSON.stringify(selected)) {
                    this.feedback = 'correct';
                    this.score++;
                } else {
                    this.feedback = 'incorrect';
                }
            },
            nextQuestion() {
                if (this.currentQuestionIndex < this.questions.length - 1) {
                    this.currentQuestionIndex++;
                    this.resetState();
                    this.shuffleCurrentQuestion();
                } else {
                    this.$refs.conclusionForm.submit();
                }
            },
            resetState() {
                this.selectedAnswers = [];
                this.isLocked = false;
                this.feedback = null;
            },
            getChoiceClass(choice) {
                if (!this.isLocked) {
                    // State before submitting an answer
                    return {
                        'bg-blue-500 text-white': this.selectedAnswers.includes(choice.originalIndex),
                        'bg-gray-200 hover:bg-gray-300': !this.selectedAnswers.includes(choice.originalIndex)
                    };
                }

                // --- After submission ---

                if (!this.isCorrectionMode) {
                    // Original modes: just disable everything visually
                    return {
                        'opacity-70': true,
                        'bg-blue-500 text-white': this.selectedAnswers.includes(choice.originalIndex),
                        'bg-gray-200': !this.selectedAnswers.includes(choice.originalIndex)
                    };
                }

                // New correction modes: detailed feedback coloring
                const correctAnswers = this.currentQuestion.correct_answers.split('|');
                const isCorrect = correctAnswers.includes(choice.originalIndex);
                const isSelected = this.selectedAnswers.includes(choice.originalIndex);

                if (isCorrect && isSelected) return { 'bg-green-500 text-white': true }; // Chosen and correct (Green)
                if (isCorrect && !isSelected) return { 'bg-yellow-400 text-black': true }; // Not chosen but correct (Yellow)
                if (!isCorrect && isSelected) return { 'bg-red-500 text-white': true }; // Chosen and wrong (Red)
                
                // Not chosen and incorrect (Faded gray)
                return { 'bg-gray-200 text-gray-500 opacity-60': true };
            }
        }
    }
</script>

<?php include 'partials/footer.php'; ?>
