<?php

function parse_questions_csv($filepath) {
    $questions = [];
    if (($handle = fopen($filepath, "r")) !== FALSE) {
        $header = fgetcsv($handle, 1000, ","); // Skip header row
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if (count($data) == count($header)) {
                 $questions[] = array_combine($header, $data);
            }
        }
        fclose($handle);
    }
    return $questions;
}

$questions = parse_questions_csv('questions.csv');
$questions_json = json_encode($questions);

$title = 'Quiz - Évaluation du patient';
include 'partials/header.php';
?>

<div x-data="quizGame(<?php echo htmlspecialchars($questions_json, ENT_QUOTES, 'UTF-8'); ?>)" x-cloak>
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
            <p class="text-2xl font-semibold mb-4 text-center" x-text="currentQuestion.question_text"></p>

            <!-- MODIFICATION ICI: Affichage d'une seule image -->
            <div class="flex justify-center items-center mb-6">
                <!-- On vérifie si un chemin d'image existe avant d'afficher la balise img -->
                <template x-if="currentQuestion.image_paths">
                    <img :src="currentQuestion.image_paths" alt="Cas clinique" class="max-w-xs md:max-w-sm rounded-lg shadow-md border">
                </template>
            </div>

            <!-- Choices (Aucun changement ici) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <template x-for="(choice, index) in currentQuestion.choices.split('|')" :key="index">
                    <button @click="toggleAnswer(index)"
                            :disabled="isLocked"
                            :class="{
                                'bg-blue-500 text-white': selectedAnswers.includes(index.toString()),
                                'bg-gray-200 hover:bg-gray-300': !selectedAnswers.includes(index.toString()),
                                'cursor-not-allowed opacity-70': isLocked
                            }"
                            class="p-4 rounded-lg text-left w-full transition duration-200">
                        <span class="font-semibold" x-text="choice"></span>
                    </button>
                </template>
            </div>

            <!-- Action Buttons and Feedback (Aucun changement ici) -->
            <div class="text-center mt-6">
                <template x-if="!isLocked">
                    <button @click="validateAnswer" :disabled="selectedAnswers.length === 0" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-3 px-8 rounded-full text-lg disabled:bg-gray-400 disabled:cursor-not-allowed">
                        Valider la réponse
                    </button>
                </template>
                <div x-show="isLocked" x-transition.opacity>
                    <div x-show="feedback === 'correct'" class="p-4 rounded-lg bg-green-100 border border-green-400">
                        <h3 class="font-bold text-green-800 text-xl">Correct !</h3>
                        <p class="text-green-700">Bonne décision. Le patient reste stable.</p>
                        <img src="assets/images/correct_saturation.webp" alt="Saturation correcte" class="mx-auto mt-2 max-h-96">
                    </div>
                    <div x-show="feedback === 'incorrect'" class="p-4 rounded-lg bg-red-100 border border-red-400">
                        <h3 class="font-bold text-red-800 text-xl">Incorrect.</h3>
                        <p class="text-red-700">Ce n'était pas la bonne réponse. Le patient désature !</p>
                        <img src="assets/images/desaturation.webp" alt="Désaturation" class="mx-auto mt-2 max-h-96">
                    </div>
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
    </form>

</div>

<script>
    function quizGame(questionsData) {
        return {
            questions: questionsData,
            currentQuestionIndex: 0,
            score: 0,
            selectedAnswers: [],
            isLocked: false,
            feedback: null,

            get currentQuestion() {
                return this.questions[this.currentQuestionIndex];
            },

            get progress() {
                return ((this.currentQuestionIndex + 1) / this.questions.length) * 100;
            },

            toggleAnswer(choiceIndex) {
                if (this.isLocked) return;
                const choiceStr = choiceIndex.toString();

                if (this.currentQuestion.type === 'single') {
                    this.selectedAnswers = [choiceStr];
                } else { // 'multiple'
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
                } else {
                    this.$refs.conclusionForm.submit();
                }
            },

            resetState() {
                this.selectedAnswers = [];
                this.isLocked = false;
                this.feedback = null;
            }
        }
    }
</script>

<?php include 'partials/footer.php'; ?>
