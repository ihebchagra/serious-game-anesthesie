# README - Serious Game : Consultation Pré-Anesthésique

- Version : 1.0
- Auteurs : Dr Samia Arfaoui, Résident Iheb Chagra
- URL : https://seriousgame.iheb.tn


1. QU'EST-CE QUE C'EST ?
--------------------------
Ce site web est un "jeu sérieux" (serious game) conçu comme un outil de formation pour les médecins, internes et résidents en anesthésie-réanimation.

L'objectif est de s'entraîner à l'évaluation pré-opératoire des patients pour anticiper et préparer la gestion des voies aériennes difficiles (ventilation au masque et intubation).

Le déroulement du jeu est le suivant :
1.  **Quiz d'images** : L'utilisateur évalue des photos de patients pour identifier des critères de difficulté.
2.  **Quiz de cas cliniques** : Des scénarios plus complets sont proposés.
3.  **Synthèse ("Unlock the Knowledge")** : À la fin, un diaporama récapitule de manière visuelle et synthétique les critères clés à retenir.

Le site propose un mode "standard" et un mode "avec correction" qui détaille les bonnes et mauvaises réponses après chaque question pour un apprentissage plus approfondi.


2. COMMENT UTILISER LE JEU ?
----------------------------------

### 2.1. Méthode Recommandée : Accès en Ligne (Pour tous les utilisateurs)

La manière la plus simple et directe d'utiliser ce serious game est de visiter le site web officiel. **Aucune installation n'est requise.**

    >>  http://seriousgame.iheb.tn  <<

Le site est accessible depuis n'importe quel ordinateur, tablette ou smartphone disposant d'un navigateur web moderne (Chrome, Firefox, Safari, Edge).


### 2.2. Méthode Alternative : Installation sur votre ordinateur

Cette méthode est destinée aux utilisateurs qui souhaitent modifier le code, ajouter leurs propres cas cliniques, ou utiliser le jeu sans connexion Internet.

**Prérequis** :
Un environnement de serveur web local qui exécute PHP. Des logiciels gratuits comme **XAMPP** (compatible Windows, macOS, et Linux) ou **MAMP** (pour macOS) sont d'excellents choix et faciles à installer.

**Étapes d'installation** :

1.  **Télécharger les fichiers du projet** :
    Récupérez tous les fichiers et placez-les dans un dossier que vous nommerez, par exemple, `serious-game`.

2.  **Placer le dossier dans le serveur web** :
    Copiez ce dossier `serious-game` dans le répertoire racine de votre serveur web local. Ce répertoire est généralement nommé :
    - **`htdocs`** (si vous utilisez XAMPP ou MAMP)
    - **`www`** (si vous utilisez WAMP)

3.  **Démarrer le serveur** :
    Lancez le panneau de contrôle de votre logiciel (XAMPP, MAMP, etc.) et assurez-vous que le service **Apache** est bien démarré.

4.  **Accéder au site** :
    Ouvrez votre navigateur web et tapez l'adresse suivante dans la barre d'adresse :
    `http://localhost/serious-game/`

    Le site devrait maintenant s'afficher et être pleinement fonctionnel.


3. TECHNOLOGIES UTILISÉES
---------------------------
Ce site est volontairement simple sur le plan technique pour être facile à maintenir et à déployer.

- **PHP** : Langage de programmation côté serveur. Il est utilisé pour lire les questions depuis les fichiers CSV et pour assembler les différentes parties des pages web.

- **Fichiers CSV (`questions.csv`, `cas.csv`)** : Ce sont de simples fichiers texte qui servent de "mini base de données". Ils contiennent toutes les questions, les options de réponse, les chemins vers les images et les bonnes réponses.
  -> **AVANTAGE MAJEUR** : Il est très facile d'ajouter ou de modifier des questions en éditant ces fichiers avec un tableur (comme Excel, LibreOffice Calc) ou un simple éditeur de texte, sans avoir à toucher au code du site.

- **HTML/CSS** : La structure et le style des pages web.

- **Tailwind CSS & Alpine.js** : Des librairies modernes (chargées depuis Internet) pour le design visuel (Tailwind) et l'interactivité du quiz (Alpine.js). Elles rendent le site agréable et dynamique sans alourdir le projet.

**NOTE IMPORTANTE** : Aucune configuration de base de données (comme MySQL) n'est nécessaire. La simplicité des fichiers CSV permet au site de fonctionner immédiatement après avoir été copié au bon endroit.
