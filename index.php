<?php

require_once 'User.php';
require_once 'Article.php';
require_once 'Category.php';
require_once 'Comment.php';
require_once 'BlogSystem.php';


function clearScreen()
{
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        system('cls');
    } else {
        system('clear');
    }
}

function readInput($message)
{
    echo $message;
    return trim(fgets(STDIN));
}

// Programme principal
function main()
{
    $system = new BlogSystem();
    $running = true;

    while ($running) {
        clearScreen();
        echo "=========================================\n";
        echo "         BLOGCMS CONSOLE EDITION\n";
        echo "=========================================\n\n";
        echo "MENU PRINCIPAL\n";
        echo "1. Se connecter\n";
        echo "2. Voir les articles\n";
        echo "3. Voir les categories\n";
        echo "4. Statistiques\n";
        echo "5. Demo\n";
        echo "0. Quitter\n";

        $choice = readInput("\nVotre choix: ");

        switch ($choice) {
            case '1':
                handleLogin($system);
                break;
            case '2':
                displayArticles($system);
                break;
            case '3':
                displayCategories($system);
                break;
            case '4':
                displayStats($system);
                break;
            case '5':
                runDemo($system);
                break;
            case '0':
                $running = false;
                echo "Au revoir!\n";
                break;
            default:
                echo "Choix invalide.\n";
                readInput("Appuyez sur Entree pour continuer...");
        }
    }
}

function handleLogin($system)
{
    clearScreen();
    echo "=== CONNEXION ===\n\n";

    $username = readInput("Nom d'utilisateur: ");
    $password = readInput("Mot de passe: ");

    if ($system->login($username, $password)) {
        $user = $system->getCurrentUser();
        echo "\nConnexion reussie! Bienvenue " . $user->getUsername() . "\n";

        // Afficher le menu selon le rôle
        if ($user->getRole() == 'admin') {
            adminMenu($system);
        } elseif ($user->getRole() == 'author') {
            authorMenu($system);
        } elseif ($user->getRole() == 'editor') {
            editorMenu($system);
        }
    } else {
        echo "\nIdentifiants incorrects.\n";
    }

    readInput("\nAppuyez sur Entree pour continuer...");
}

function displayArticles($system)
{
    clearScreen();
    echo "=== LISTE DES ARTICLES ===\n\n";

    $articles = $system->getArticles();

    if (empty($articles)) {
        echo "Aucun article disponible.\n";
    } else {
        foreach ($articles as $article) {
            echo $article->getShortInfo() . "\n";
        }

        echo "\nCommandes:\n";
        echo "  voir [ID] - Voir un article\n";
        echo "  retour    - Retour au menu\n";

        $command = readInput("\nCommande: ");

        if (preg_match('/^voir (\d+)$/i', $command, $matches)) {
            viewArticle($system, (int)$matches[1]);
        }
    }

    readInput("\nAppuyez sur Entree pour continuer...");
}

function viewArticle($system, $id)
{
    $article = $system->getArticle($id);

    if ($article) {
        clearScreen();
        echo $article->ArticleInfo() . "\n";
    } else {
        echo "Article non trouve.\n";
    }
}

function displayCategories($system)
{
    clearScreen();
    echo "=== LISTE DES CATEGORIES ===\n\n";

    echo $system->getCategoryTree();

    readInput("\nAppuyez sur Entree pour continuer...");
}

function displayStats($system)
{
    clearScreen();
    echo "=== STATISTIQUES ===\n\n";

    $stats = $system->getStats();

    echo "Utilisateurs: " . $stats['users'] . "\n";
    echo "Articles: " . $stats['articles'] . "\n";
    echo "  - Publies: " . $stats['published_articles'] . "\n";
    echo "  - Brouillons: " . $stats['draft_articles'] . "\n";
    echo "  - Archives: " . $stats['archived_articles'] . "\n";
    echo "Categories: " . $stats['categories'] . "\n";
    echo "Commentaires: " . $stats['comments'] . "\n";

    readInput("\nAppuyez sur Entree pour continuer...");
}

function adminMenu($system)
{
    $running = true;

    while ($running) {
        clearScreen();
        $user = $system->getCurrentUser();
        echo "=== MENU ADMINISTRATEUR ===\n";
        echo "Connecte en tant que: " . $user->getUsername() . "\n\n";

        echo "1. Gerer les utilisateurs\n";
        echo "2. Gerer les articles\n";
        echo "3. Gerer les categories\n";
        echo "4. Voir mes informations\n";
        echo "5. Se deconnecter\n";

        $choice = readInput("\nVotre choix: ");

        switch ($choice) {
            case '1':
                manageUsers($system);
                break;
            case '2':
                manageArticles($system);
                break;
            case '3':
                manageCategories($system);
                break;
            case '4':
                clearScreen();
                echo $user->getUserInfo();
                readInput("\nAppuyez sur Entree pour continuer...");
                break;
            case '5':
                $system->logout();
                $running = false;
                break;
        }
    }
}

function manageUsers($system)
{
    clearScreen();
    echo "=== GESTION DES UTILISATEURS ===\n\n";

    $users = $system->getUsers();

    foreach ($users as $user) {
        echo $user->getShortInfo() . "\n";
    }

    readInput("\nAppuyez sur Entree pour continuer...");
}

function manageArticles($system)
{
    clearScreen();
    echo "=== GESTION DES ARTICLES ===\n\n";

    $articles = $system->getArticles();

    foreach ($articles as $article) {
        echo $article->getShortInfo() . "\n";
    }

    echo "\nCommandes:\n";
    echo "  publier [ID] - Publier un article\n";
    echo "  supprimer [ID] - Supprimer un article\n";
    echo "  retour - Retour\n";

    $command = readInput("\nCommande: ");

    if (preg_match('/^publier (\d+)$/i', $command, $matches)) {
        $article = $system->getArticle((int)$matches[1]);
        if ($article) {
            $article->publish();
            echo "Article publie avec succes.\n";
        }
    } elseif (preg_match('/^supprimer (\d+)$/i', $command, $matches)) {
        echo "Fonctionnalite a implementer.\n";
    }

    readInput("\nAppuyez sur Entree pour continuer...");
}

function manageCategories($system)
{
    clearScreen();
    echo "=== GESTION DES CATEGORIES ===\n\n";

    echo $system->getCategoryTree();

    readInput("\nAppuyez sur Entree pour continuer...");
}

function authorMenu($system)
{
    $running = true;
    $user = $system->getCurrentUser();

    while ($running) {
        clearScreen();
        echo "=== MENU AUTEUR ===\n";
        echo "Connecte en tant que: " . $user->getUsername() . "\n\n";

        echo "1. Mes articles\n";
        echo "2. Creer un article\n";
        echo "3. Voir les categories\n";
        echo "4. Mes informations\n";
        echo "5. Se deconnecter\n";

        $choice = readInput("\nVotre choix: ");

        switch ($choice) {
            case '1':
                displayMyArticles($system, $user);
                break;
            case '2':
                createArticle($system, $user);
                break;
            case '3':
                displayCategories($system);
                break;
            case '4':
                clearScreen();
                echo $user->getUserInfo();
                readInput("\nAppuyez sur Entree pour continuer...");
                break;
            case '5':
                $system->logout();
                $running = false;
                break;
        }
    }
}

function displayMyArticles($system, $user)
{
    clearScreen();
    echo "=== MES ARTICLES ===\n\n";

    $myArticles = array_filter($system->getArticles(), function ($article) use ($user) {
        return $article->getAuthor()->getId() == $user->getId();
    });

    if (empty($myArticles)) {
        echo "Vous n'avez aucun article.\n";
    } else {
        foreach ($myArticles as $article) {
            echo $article->getShortInfo() . "\n";
        }
    }

    readInput("\nAppuyez sur Entree pour continuer...");
}

function createArticle($system, $user)
{
    clearScreen();
    echo "=== CREATION D'ARTICLE ===\n\n";

    $title = readInput("Titre: ");
    $content = readInput("Contenu: ");

    // Créer l'article
    $article = new Article($title, $content, $user);

    // Ajouter aux catégories
    $categories = $system->getCategories();
    if (!empty($categories)) {
        echo "\nCategories disponibles:\n";
        foreach ($categories as $category) {
            echo "[{$category->getId()}] {$category->getName()}\n";
        }

        $catIds = readInput("\nIDs des categories (separes par virgules): ");
        $catIds = array_map('intval', explode(',', $catIds));

        foreach ($catIds as $catId) {
            $category = $system->getCategory($catId);
            if ($category) {
                $article->addCategory($category);
            }
        }
    }

    $system->addArticle($article);

    echo "\nArticle cree avec succes! (ID: {$article->getId()})\n";

    if (readInput("Voulez-vous publier cet article? (o/n): ") == 'o') {
        $article->publish();
        echo "Article publie!\n";
    }

    readInput("\nAppuyez sur Entree pour continuer...");
}

function editorMenu($system)
{
    echo "Menu editeur (a implementer)\n";
    readInput("\nAppuyez sur Entree pour continuer...");
}

function runDemo($system)
{
    clearScreen();
    echo "=== DEMONSTRATION BLOGCMS ===\n\n";
    // 1. Afficher les statistiques
    echo "1. STATISTIQUES\n";
    $stats = $system->getStats();
    echo "   Utilisateurs: {$stats['users']}\n";
    echo "   Articles: {$stats['articles']}\n";
    echo "   Categories: {$stats['categories']}\n";
    echo "   Commentaires: {$stats['comments']}\n\n";

    // 2. Afficher les utilisateurs
    echo "2. UTILISATEURS\n";
    foreach ($system->getUsers() as $user) {
        echo "   " . $user->getShortInfo() . "\n";
    }
    echo "\n";

    // 3. Afficher les articles
    echo "3. ARTICLES\n";
    foreach ($system->getArticles() as $article) {
        echo "   " . $article->getShortInfo() . "\n";
    }

    readInput("\nAppuyez sur Entree pour continuer...");
}

// Lancer l'application
main();
