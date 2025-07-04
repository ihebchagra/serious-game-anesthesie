<?php
$title = 'Unlock the Knowledge - Synthèse des critères';
include 'partials/header.php';
?>

<!-- Alpine.js component for the slideshow -->
<div x-data="slideshow()" x-cloak class="max-w-5xl mx-auto bg-white p-4 md:p-8 rounded-lg shadow-lg">

    <!-- Header and Progress Bar -->
    <div class="text-center mb-4">
        <h1 class="text-3xl md:text-4xl font-bold text-blue-700">Unlock the Knowledge</h1>
        <p class="text-lg text-gray-600">Synthèse des critères de difficulté des voies aériennes</p>
    </div>
    <div class="w-full bg-gray-200 rounded-full h-2.5 mb-6">
        <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-500" :style="`width: ${progress}%`"></div>
    </div>

    <!-- Slides Container -->
    <!-- FIX: Increased min-height slightly for better spacing on mobile -->
    <div class="relative min-h-[65vh] md:min-h-[70vh]">

        <!-- 🟩 Slide 1: Introduction -->
        <div x-show="currentSlide === 1" x-transition.opacity.duration.500ms class="absolute inset-0 flex flex-col items-center justify-center p-4 text-center bg-gradient-to-br from-blue-50 to-green-50 rounded-lg">
            <div class="absolute top-4 right-4 text-gray-300 opacity-60">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v3m-6 4h12a2 2 0 002-2v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7a2 2 0 002 2z" /></svg>
            </div>
            <!-- FIX: Adjusted font sizes for better mobile readability -->
            <h2 class="text-3xl md:text-5xl font-extrabold text-gray-800 leading-tight">Ce qu’il faut retenir pour <span class="text-blue-600">anticiper</span> et <span class="text-green-600">prévenir</span> l’échec.</h2>
            <p class="mt-4 text-lg md:text-xl text-gray-700 max-w-3xl">Une synthèse des critères de ventilation et d'intubation difficile en pratique clinique.</p>
        </div>

        <!-- 🟦 Slide 2: Ventilation Dificulté -->
        <!-- FIX: Added overflow-y-auto to allow vertical scrolling on tall screens if needed -->
        <div x-show="currentSlide === 2" x-transition.opacity.duration.500ms class="absolute inset-0 p-4 overflow-y-auto">
            <h2 class="text-xl sm:text-2xl font-bold text-blue-800 mb-4 text-center">Critères de Ventilation Difficile à Connaître</h2>
            <!-- FIX: This div handles horizontal scrolling for the table on mobile -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm sm:text-base text-left border-collapse">
                    <thead class="bg-blue-100">
                        <tr>
                            <th class="p-2 sm:p-3 font-semibold text-blue-900 border-b-2 border-blue-200">Critère</th>
                            <th class="p-2 sm:p-3 font-semibold text-blue-900 border-b-2 border-blue-200">Mécanisme</th>
                            <th class="p-2 sm:p-3 font-semibold text-blue-900 border-b-2 border-blue-200">Illustration</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50">
                            <td class="p-2 sm:p-3"><span class="font-bold">🧔‍♂️ Barbe</span></td>
                            <td class="p-2 sm:p-3">Fuite masquée, absence d’étanchéité</td>
                            <td class="p-2 sm:p-3">Patient barbu, difficulté à faire adhérer le masque</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="p-2 sm:p-3"><span class="font-bold">⚖️ Obésité (IMC > 30)</span></td>
                            <td class="p-2 sm:p-3">Compression thoracique, encombrement tissulaire</td>
                            <td class="p-2 sm:p-3">Thorax massif, position difficile</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="p-2 sm:p-3"><span class="font-bold">😴 SAOS connu</span></td>
                            <td class="p-2 sm:p-3">Hypotonie, collapsus pharyngé</td>
                            <td class="p-2 sm:p-3">Antécédent de ronflements sévères, fatigue diurne</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="p-2 sm:p-3"><span class="font-bold">👴 Sujets âgés</span></td>
                            <td class="p-2 sm:p-3">Tonicité faible, langue molle, ouverture buccale difficile</td>
                            <td class="p-2 sm:p-3">Édentement possible, sédation à risque</td>
                        </tr>
                         <tr class="hover:bg-gray-50">
                            <td class="p-2 sm:p-3"><span class="font-bold">🦷 Édenté</span></td>
                            <td class="p-2 sm:p-3">Fuite autour du masque, mauvaise emboîture</td>
                            <td class="p-2 sm:p-3">Absence de points d’appui pour le masque</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p class="text-center text-sm text-gray-500 mt-4 italic">SAOS: Syndrome d'Apnées Obstructives du Sommeil</p>
        </div>

        <!-- 🟧 Slide 3: Intubation Dificulté -->
        <!-- FIX: overflow-y-auto was already here, which is correct! It allows the whole slide to scroll if content is too tall. -->
        <div x-show="currentSlide === 3" x-transition.opacity.duration.500ms class="absolute inset-0 p-4 overflow-y-auto">
            <h2 class="text-xl sm:text-2xl font-bold text-orange-800 mb-4 text-center bg-orange-100 p-2 rounded-md">Critères d’Intubation Difficile (Évaluation prédictive)</h2>
            
            <div class="overflow-x-auto mb-8">
                <table class="w-full text-sm sm:text-base text-left border-collapse">
                     <thead class="bg-orange-100">
                        <tr>
                            <th class="p-2 sm:p-3 font-semibold text-orange-900 border-b-2 border-orange-200">Critère</th>
                            <th class="p-2 sm:p-3 font-semibold text-orange-900 border-b-2 border-orange-200">Élément évalué</th>
                            <th class="p-2 sm:p-3 font-semibold text-orange-900 border-b-2 border-orange-200">Traduction</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50"><td class="p-2 sm:p-3 font-bold">Mallampati III/IV</td><td class="p-2 sm:p-3">Visualisation oropharyngée</td><td class="p-2 sm:p-3">Espaces rétro-linguaux réduits</td></tr>
                        <tr class="hover:bg-gray-50"><td class="p-2 sm:p-3 font-bold">Ouverture buccale < 3 cm</td><td class="p-2 sm:p-3">Passage laryngoscope</td><td class="p-2 sm:p-3">Lame difficile à insérer</td></tr>
                        <tr class="hover:bg-gray-50"><td class="p-2 sm:p-3 font-bold">Distance thyro-mentonnière < 6,5 cm</td><td class="p-2 sm:p-3">Axe glottique</td><td class="p-2 sm:p-3">Alignement sous-optimal</td></tr>
                        <tr class="hover:bg-gray-50"><td class="p-2 sm:p-3 font-bold">Mobilité cervicale réduite</td><td class="p-2 sm:p-3">Axe visuel</td><td class="p-2 sm:p-3">Hyperextension limitée</td></tr>
                        <tr class="hover:bg-gray-50"><td class="p-2 sm:p-3 font-bold">Protrusion incisive</td><td class="p-2 sm:p-3">Passage du tube</td><td class="p-2 sm:p-3">Dents gênantes en avant</td></tr>
                    </tbody>
                </table>
            </div>
        
            <div class="p-4 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 text-center mb-4">Illustration : Score de Mallampati</h3>
                <!-- FIX: Made image responsive. It will take the full width of its container but not exceed 280px. -->
                <img src="assets/images/mallampati.webp" 
                     alt="Illustration des classes de Mallampati" 
                     class="w-full max-w-[280px] h-auto mx-auto rounded-lg shadow-md border">
            </div>
        </div>

        <!-- 🟨 Slide 4: Distinction -->
        <!-- FIX: Added overflow-y-auto for vertical scrolling -->
        <div x-show="currentSlide === 4" x-transition.opacity.duration.500ms class="absolute inset-0 p-4 bg-yellow-50 rounded-lg overflow-y-auto">
             <h2 class="text-xl sm:text-2xl font-bold text-yellow-800 mb-4 text-center">Différencier les deux difficultés</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm sm:text-base text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="p-2 sm:p-3 font-semibold bg-gray-200 text-gray-800 border-b-2 border-gray-300">Dimension</th>
                            <th class="p-2 sm:p-3 font-semibold bg-blue-100 text-blue-900 border-b-2 border-blue-200">Ventilation 😷</th>
                            <th class="p-2 sm:p-3 font-semibold bg-orange-100 text-orange-900 border-b-2 border-orange-200">Intubation 🩺</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr><td class="p-2 sm:p-3 font-bold bg-gray-100">Moment</td><td class="p-2 sm:p-3">Avant l’intubation</td><td class="p-2 sm:p-3">Pendant l’intubation</td></tr>
                        <tr><td class="p-2 sm:p-3 font-bold bg-gray-100">Évaluation</td><td class="p-2 sm:p-3">Masque + thorax</td><td class="p-2 sm:p-3">Axe glottique</td></tr>
                        <tr><td class="p-2 sm:p-3 font-bold bg-gray-100">Conséquences</td><td class="p-2 sm:p-3">Hypoxie rapide</td><td class="p-2 sm:p-3">Traumatisme, échec</td></tr>
                        <tr><td class="p-2 sm:p-3 font-bold bg-gray-100">Solutions</td><td class="p-2 sm:p-3">2 mains, canule</td><td class="p-2 sm:p-3">Videolaryngo, guide</td></tr>
                    </tbody>
                </table>
            </div>
            <p class="text-center mt-4 text-gray-700 italic">Une erreur fréquente est de confondre les deux !</p>
        </div>
        
        <!-- 🟥 Slide 5: Solutions -->
        <!-- FIX: Added overflow-y-auto for vertical scrolling -->
        <div x-show="currentSlide === 5" x-transition.opacity.duration.500ms class="absolute inset-0 p-4 overflow-y-auto">
             <h2 class="text-xl sm:text-2xl font-bold text-red-800 mb-4 text-center">Et si je prévois une difficulté ?</h2>
            <div class="overflow-x-auto">
                 <table class="w-full text-sm sm:text-base text-left border-collapse">
                    <thead class="bg-red-100">
                        <tr>
                            <th class="p-2 sm:p-3 font-semibold text-red-900 border-b-2 border-red-200">Difficulté</th>
                            <th class="p-2 sm:p-3 font-semibold text-red-900 border-b-2 border-red-200">Matériel</th>
                            <th class="p-2 sm:p-3 font-semibold text-red-900 border-b-2 border-red-200">Préparation</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50">
                            <td class="p-2 sm:p-3 text-blue-700 font-bold">Ventilation</td>
                            <td class="p-2 sm:p-3">Canule, 2e main, masque anatomique</td>
                            <td class="p-2 sm:p-3">Pré-oxygénation, plan B</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="p-2 sm:p-3 text-orange-700 font-bold">Intubation</td>
                            <td class="p-2 sm:p-3">Videolaryngoscope, bougie, stylet</td>
                            <td class="p-2 sm:p-3">Alerte équipe, check matériel</td>
                        </tr>
                    </tbody>
                 </table>
            </div>
            <div class="mt-6 p-4 border-l-4 border-red-600 bg-red-50 rounded-r-lg">
                <p class="font-bold text-red-800 text-lg">Ne jamais improviser devant une difficulté prévisible.</p>
            </div>
        </div>

        <div x-show="currentSlide === 6" x-transition.opacity.duration.500ms class="absolute inset-0 p-4 overflow-y-auto">
            <div class="w-full max-w-4xl mx-auto">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 text-center mb-6">
                    Résumé visuel : les 10 critères clés
                </h2>
                                                                                                                                                                                                           
                <!-- Ventilation Criteria Section -->
                <div class="mb-8">
                    <div class="bg-blue-600 text-white font-bold text-center py-2 rounded-t-lg text-lg">
                        CRITÈRES DE VENTILATION DIFFICILE
                    </div>
                    <div class="bg-blue-50 p-4 md:p-6 rounded-b-lg grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                        <!-- Item 1: Âge avancé -->
                        <div class="flex flex-col items-center text-center">
                            <img src="assets/images/pict_age.webp" alt="Âge avancé" class="w-20 h-20 md:w-24 md:h-24 rounded-full border-4 border-white shadow-lg object-cover">
                            <p class="mt-2 font-semibold text-blue-900 text-sm md:text-base">Âge avancé</p>
                        </div>
                        <!-- Item 2: Barbe -->
                        <div class="flex flex-col items-center text-center">
                            <img src="assets/images/pict_barbe.webp" alt="Barbe" class="w-20 h-20 md:w-24 md:h-24 rounded-full border-4 border-white shadow-lg object-cover">
                            <p class="mt-2 font-semibold text-blue-900 text-sm md:text-base">Barbe</p>
                        </div>
                        <!-- Item 3: Obésité -->
                        <div class="flex flex-col items-center text-center">
                            <img src="assets/images/pict_obesite.webp" alt="Obésité" class="w-20 h-20 md:w-24 md:h-24 rounded-full border-4 border-white shadow-lg object-cover">
                            <p class="mt-2 font-semibold text-blue-900 text-sm md:text-base">Obésité</p>
                        </div>
                        <!-- Item 4: Édenté -->
                        <div class="flex flex-col items-center text-center">
                            <img src="assets/images/pict_bouche.webp" alt="Édenté" class="w-20 h-20 md:w-24 md:h-24 rounded-full border-4 border-white shadow-lg object-cover">
                            <p class="mt-2 font-semibold text-blue-900 text-sm md:text-base">Édenté</p>
                        </div>
                        <!-- Item 5: SAOS connu -->
                        <div class="flex flex-col items-center text-center">
                            <img src="assets/images/pict_saos.webp" alt="SAOS connu" class="w-20 h-20 md:w-24 md:h-24 rounded-full border-4 border-white shadow-lg object-cover">
                            <p class="mt-2 font-semibold text-blue-900 text-sm md:text-base">SAOS connu</p>
                        </div>
                    </div>
                </div>
                                                                                                                                                                                                           
                <!-- Intubation Criteria Section -->
                <div>
                    <div class="bg-orange-500 text-white font-bold text-center py-2 rounded-t-lg text-lg">
                        CRITÈRES D'INTUBATION DIFFICILE
                    </div>
                    <div class="bg-orange-50 p-4 md:p-6 rounded-b-lg grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                        <!-- Item 1: Mallampati -->
                        <div class="flex flex-col items-center text-center">
                            <img src="assets/images/pict_mallampati.webp" alt="Score Mallampati" class="w-20 h-20 md:w-24 md:h-24 rounded-full border-4 border-white shadow-lg object-cover">
                            <p class="mt-2 font-semibold text-orange-900 text-sm md:text-base">Score Mallampati</p>
                        </div>
                        <!-- Item 2: Ouverture buccale -->
                        <div class="flex flex-col items-center text-center">
                            <img src="assets/images/pict_3cm.webp" alt="Ouverture buccale < 3 cm" class="w-20 h-20 md:w-24 md:h-24 rounded-full border-4 border-white shadow-lg object-cover">
                            <p class="mt-2 font-semibold text-orange-900 text-sm md:text-base">Ouverture buccale < 3 cm</p>
                        </div>
                        <!-- Item 3: Distance thyro-mentonnière -->
                        <div class="flex flex-col items-center text-center">
                            <img src="assets/images/pict_dtm.webp" alt="Distance thyro-mentonnière" class="w-20 h-20 md:w-24 md:h-24 rounded-full border-4 border-white shadow-lg object-cover">
                            <p class="mt-2 font-semibold text-orange-900 text-sm md:text-base">Distance thyro-mentonnière < 6,5 cm</p>
                        </div>
                        <!-- Item 4: Mobilité cervicale -->
                        <div class="flex flex-col items-center text-center">
                            <img src="assets/images/pict_nuque.webp" alt="Mobilité cervicale réduite" class="w-20 h-20 md:w-24 md:h-24 rounded-full border-4 border-white shadow-lg object-cover">
                            <p class="mt-2 font-semibold text-orange-900 text-sm md:text-base">Mobilité cervicale</p>
                        </div>
                        <!-- Item 5: Protrusion incisive -->
                        <div class="flex flex-col items-center text-center">
                            <img src="assets/images/pict_prot.webp" alt="Protrusion incisive" class="w-20 h-20 md:w-24 md:h-24 rounded-full border-4 border-white shadow-lg object-cover">
                            <p class="mt-2 font-semibold text-orange-900 text-sm md:text-base">Protrusion incisive</p>
                        </div>
                    </div>
                </div>
                                                                                                                                                                                                           
            </div>
        </div>

    </div>

    <!-- Navigation -->
    <div class="flex justify-between items-center mt-8 pt-4 border-t">
        <button @click="prevSlide()" :disabled="currentSlide === 1" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 sm:px-6 rounded-full disabled:bg-gray-300 disabled:cursor-not-allowed">
            ← <span class="hidden sm:inline">Précédent</span>
        </button>
        <div class="text-gray-700 font-semibold">
            <span x-text="currentSlide"></span> / <span x-text="totalSlides"></span>
        </div>
        
        <template x-if="currentSlide < totalSlides">
             <button @click="nextSlide()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 sm:px-6 rounded-full">
                <span class="hidden sm:inline">Suivant</span> →
            </button>
        </template>
        <template x-if="currentSlide === totalSlides">
            <a href="index.php" class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 sm:px-6 rounded-full">
                Réessayer
            </a>
        </template>
    </div>
</div>

<script>
    function slideshow() {
        return {
            currentSlide: 1,
            totalSlides: 6,
            get progress() {
                if (this.totalSlides === 0) return 0;
                // Make progress bar start from 0 and finish at 100
                return ((this.currentSlide - 1) / (this.totalSlides - 1)) * 100;
            },
            nextSlide() {
                if (this.currentSlide < this.totalSlides) {
                    this.currentSlide++;
                }
            },
            prevSlide() {
                if (this.currentSlide > 1) {
                    this.currentSlide--;
                }
            }
        }
    }
</script>

<?php include 'partials/footer.php'; ?>
