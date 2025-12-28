<?php
class BlogSystem
{
    private array $users = [];
    private array $articles = [];
    private array $categories = [];
    private array $comments = [];
    private ?User $currentUser = null;

    public function __construct()
    {
        $this->initializeExtendedData();
    }

    private function initializeExtendedData(): void
    {
        $this->createUsers();
        $this->createCategories();
        $this->createArticles();
        $this->createComments();
    }

    private function createUsers(): void
    {
        $usersData = [
            // Administrateurs
            ['admin', 'admin@blogcms.com', 'admin123', 'admin'],
            ['amina', 'amina@mediagroup.com', 'amina123', 'admin'],

            // Éditeurs
            ['thomas', 'thomas@mediagroup.com', 'thomas123', 'editor'],
            ['marie', 'marie@mediagroup.com', 'marie123', 'editor'],
            ['pierre', 'pierre@mediagroup.com', 'pierre123', 'editor'],

            // Auteurs
            ['lea', 'lea@mediagroup.com', 'lea123', 'author'],
            ['sophie', 'sophie@mediagroup.com', 'sophie123', 'author'],
            ['lucas', 'lucas@mediagroup.com', 'lucas123', 'author'],
            ['julie', 'julie@mediagroup.com', 'julie123', 'author'],
            ['antoine', 'antoine@mediagroup.com', 'antoine123', 'author']
        ];

        foreach ($usersData as $userData) {
            $this->addUser(new User($userData[0], $userData[1], $userData[2], $userData[3]));
        }
    }

    private function createCategories(): void
    {
        $categoriesData = [
            ['Technologie', 'Actualités et innovations tech'],
            ['Programmation', 'Développement logiciel'],
            ['Intelligence Artificielle', 'IA et Machine Learning'],
            ['Cybersécurité', 'Sécurité informatique'],
            ['Sciences', 'Découvertes scientifiques'],
            ['Santé', 'Bien-être et médecine'],
            ['Économie', 'Finance et business'],
            ['Culture', 'Arts et littérature'],
            ['Éducation', 'Apprentissage et formation'],
            ['Voyage', 'Découvertes et aventures']
        ];

        foreach ($categoriesData as $categoryData) {
            $this->addCategory(new Category($categoryData[0], $categoryData[1]));
        }
    }

    private function createArticles(): void
    {
        $users = array_values($this->users);

        $articlesData = [
            // Articles Technologie
            [
                'Les tendances tech 2024',
                'Découvrez les technologies qui vont marquer l\'année 2024 : IA, réalité virtuelle, 5G...',
                $users[2], // Thomas (éditeur)
                ['Technologie', 'Intelligence Artificielle'],
                'published'
            ],
            [
                'Introduction à la POO en PHP',
                'La programmation orientée objet permet de structurer le code de manière plus modulaire...',
                $users[5], // Léa (auteur)
                ['Programmation', 'Technologie'],
                'published'
            ],
            [
                'Sécurisez vos applications web',
                'Guide complet pour protéger vos applications contre les attaques courantes...',
                $users[3], // Marie (éditeur)
                ['Cybersécurité', 'Programmation'],
                'published'
            ],
            [
                'Python vs JavaScript : quel choix ?',
                'Comparaison détaillée entre Python et JavaScript pour le développement web...',
                $users[6], // Sophie (auteur)
                ['Programmation', 'Technologie'],
                'published'
            ],
            [
                'L\'IA dans la santé',
                'Comment l\'intelligence artificielle révolutionne le domaine médical...',
                $users[4], // Pierre (éditeur)
                ['Intelligence Artificielle', 'Santé'],
                'published'
            ],

            // Articles Sciences
            [
                'Découverte d\'une nouvelle exoplanète',
                'Les astronomes ont identifié une planète potentiellement habitable...',
                $users[7], // Lucas (auteur)
                ['Sciences'],
                'published'
            ],
            [
                'Les bienfaits de la méditation',
                'Étude scientifique sur les effets positifs de la méditation sur le cerveau...',
                $users[8], // Julie (auteur)
                ['Santé', 'Sciences'],
                'published'
            ],

            // Articles Économie
            [
                'Les cryptomonnaies en 2024',
                'Analyse du marché des cryptomonnaies et perspectives d\'avenir...',
                $users[9], // Antoine (auteur)
                ['Économie', 'Technologie'],
                'draft'
            ],
            [
                'Startups à suivre cette année',
                'Liste des startups prometteuses dans différents secteurs d\'activité...',
                $users[2], // Thomas
                ['Économie', 'Technologie'],
                'published'
            ],

            // Articles Culture
            [
                'Les meilleurs livres de l\'année',
                'Sélection des romans et essais les plus marquants de l\'année...',
                $users[5], // Léa
                ['Culture', 'Éducation'],
                'published'
            ],
            [
                'Histoire du cinéma français',
                'Retour sur les grands moments du cinéma français depuis ses débuts...',
                $users[6], // Sophie
                ['Culture'],
                'draft'
            ],

            // Articles Éducation
            [
                'Apprendre à coder gratuitement',
                'Ressources et plateformes pour apprendre la programmation sans dépenser d\'argent...',
                $users[7], // Lucas
                ['Éducation', 'Programmation'],
                'published'
            ],
            [
                'Les MOOCs du moment',
                'Guide des meilleurs cours en ligne disponibles actuellement...',
                $users[3], // Marie
                ['Éducation'],
                'published'
            ],

            // Articles Voyage
            [
                'Destinations insolites pour 2024',
                'Découvrez des lieux peu touristiques mais incroyables à visiter...',
                $users[8], // Julie
                ['Voyage'],
                'published'
            ],
            [
                'Voyager éco-responsable',
                'Conseils pour réduire son impact environnemental lors de ses voyages...',
                $users[9], // Antoine
                ['Voyage', 'Éducation'],
                'draft'
            ]
        ];

        foreach ($articlesData as $articleData) {
            $article = new Article($articleData[0], $articleData[1], $articleData[2]);

            // Ajouter les catégories
            foreach ($articleData[3] as $categoryName) {
                $category = $this->getCategoryByName($categoryName);
                if ($category) {
                    $article->addCategory($category);
                }
            }

            // Définir le statut
            if ($articleData[4] === 'published') {
                $article->publish();
            }

            $this->addArticle($article);
        }
    }

    private function createComments(): void
    {
        $articles = array_values($this->articles);
        $users = array_values($this->users);

        $commentsData = [
            ['Excellent article, très complet !', $users[0], $articles[0]],
            ['Je ne suis pas d\'accord sur certains points...', $users[5], $articles[0]],
            ['Merci pour ce panorama détaillé.', $users[7], $articles[0]],

            ['Parfait pour les débutants, merci !', $users[6], $articles[1]],
            ['J\'aurais aimé plus d\'exemples pratiques.', $users[8], $articles[1]],
            ['Très bien expliqué, clair et concis.', $users[3], $articles[1]],

            ['Article essentiel pour tous les développeurs.', $users[1], $articles[2]],
            ['Pourriez-vous faire un article plus avancé ?', $users[9], $articles[2]],

            ['Comparaison très objective, bravo.', $users[2], $articles[3]],
            ['Et TypeScript dans tout ça ?', $users[4], $articles[3]],

            ['Fascinant ! L\'avenir de la médecine.', $users[5], $articles[4]],
            ['Il faut rester prudent avec l\'IA médicale.', $users[7], $articles[4]],

            ['Incroyable découverte !', $users[6], $articles[5]],
            ['Quand pourrons-nous y aller ?', $users[8], $articles[5]],

            ['Pratique la méditation depuis 2 ans, ça change la vie.', $users[0], $articles[6]],
            ['Des études scientifiques solides ?', $users[2], $articles[6]],

            ['Article intéressant mais trop optimiste à mon avis.', $users[3], $articles[7]],

            // Commentaires pour l'article 9 (Startups)
            ['Quelques startups manquent à la liste.', $users[4], $articles[8]],
            ['Bonne sélection, merci.', $users[6], $articles[8]],

            ['J\'ai déjà lu 3 livres de la liste, excellents !', $users[7], $articles[9]],

            ['Dommage que l\'article ne soit pas publié.', $users[8], $articles[10]],

            ['Super ressources, merci beaucoup !', $users[9], $articles[11]],
            ['Je recommande aussi freeCodeCamp.', $users[0], $articles[11]],

            ['Coursera reste la meilleure plateforme.', $users[1], $articles[12]],

            ['J\'ai visité 2 de ces destinations, magnifiques !', $users[2], $articles[13]],

            ['Article important pour notre planète.', $users[3], $articles[14]],
            ['Conseils pratiques et réalisables.', $users[5], $articles[14]]
        ];

        foreach ($commentsData as $commentData) {
            $comment = new Comment(
                $commentData[0],
                $commentData[1]->getId(),
                $commentData[2]->getId()
            );

            $commentData[2]->addComment($comment);
            $this->addComment($comment);
        }
    }

    private function getCategoryByName(string $name): ?Category
    {
        foreach ($this->categories as $category) {
            if ($category->getName() === $name) {
                return $category;
            }
        }
        return null;
    }

    // Méthodes d'ajout
    public function addUser(User $user): void
    {
        $this->users[$user->getId()] = $user;
    }
    public function getVisibleArticles(?User $user = null): array
    {
        $visibleArticles = [];

        foreach ($this->articles as $article) {
            if ($article->getStatus() === 'published') {
                $visibleArticles[] = $article;
            } elseif ($article->getStatus() === 'draft') {
                if ($user) {
                    if ($user->getRole() === 'admin' || $user->getRole() === 'editor') {
                        $visibleArticles[] = $article;
                    } elseif ($user->getRole() === 'author' && $article->getAuthor()->getId() === $user->getId()) {
                        $visibleArticles[] = $article;
                    }
                }
            } elseif ($article->getStatus() === 'archived') {
                if ($user && ($user->getRole() === 'admin' || $user->getRole() === 'editor')) {
                    $visibleArticles[] = $article;
                }
            }
        }

        return $visibleArticles;
    }

    public function addArticle(Article $article): void
    {
        $this->articles[$article->getId()] = $article;
    }

    public function addCategory(Category $category): void
    {
        $this->categories[$category->getId()] = $category;
    }

    public function addComment(Comment $comment): void
    {
        $this->comments[$comment->getId()] = $comment;
    }

    // Getters
    public function getUsers(): array
    {
        return $this->users;
    }
    public function getArticles(): array
    {
        return $this->articles;
    }
    public function getCategories(): array
    {
        return $this->categories;
    }
    public function getComments(): array
    {
        return $this->comments;
    }
    public function getCurrentUser(): ?User
    {
        return $this->currentUser;
    }

    public function getUser(int $id): ?User
    {
        return $this->users[$id] ?? null;
    }

    public function getArticle(int $id): ?Article
    {
        return $this->articles[$id] ?? null;
    }

    public function getCategory(int $id): ?Category
    {
        return $this->categories[$id] ?? null;
    }

    public function getComment(int $id): ?Comment
    {
        return $this->comments[$id] ?? null;
    }

    public function getCategoryByNamePublic(string $name): ?Category
    {
        return $this->getCategoryByName($name);
    }

    // Authentification
    public function login(string $username, string $password): bool
    {
        foreach ($this->users as $user) {
            if ($user->getUsername() === $username && $user->getPassword() === $password) {
                $this->currentUser = $user;
                $user->setLastLogin();
                return true;
            }
        }
        return false;
    }

    public function logout(): void
    {
        $this->currentUser = null;
    }

    // Statistiques
    public function getStats(): array
    {
        return [
            'users' => count($this->users),
            'articles' => count($this->articles),
            'categories' => count($this->categories),
            'comments' => count($this->comments),
            'published_articles' => count(array_filter($this->articles, fn($a) => $a->getStatus() === 'published')),
            'draft_articles' => count(array_filter($this->articles, fn($a) => $a->getStatus() === 'draft')),
            'archived_articles' => count(array_filter($this->articles, fn($a) => $a->getStatus() === 'archived')),
        ];
    }

    // Recherche
    public function searchArticles(string $query): array
    {
        $results = [];
        foreach ($this->articles as $article) {
            if (
                stripos($article->getTitle(), $query) !== false ||
                stripos($article->getContent(), $query) !== false
            ) {
                $results[] = $article;
            }
        }
        return $results;
    }

    public function getArticlesByCategory(int $categoryId): array
    {
        $category = $this->getCategory($categoryId);
        if (!$category) return [];

        return array_filter($this->articles, function ($article) use ($category) {
            return in_array($category, $article->getCategories(), true);
        });
    }

    public function getArticlesByAuthor(int $authorId): array
    {
        return array_filter($this->articles, function ($article) use ($authorId) {
            return $article->getAuthor()->getId() === $authorId;
        });
    }

    public function getCategoryTree(): string
    {
        if (empty($this->categories)) {
            return "Aucune catégorie.\n";
        }

        $tree = "LISTE DES CATEGORIES\n";
        $tree .= str_repeat("=", 30) . "\n";

        foreach ($this->categories as $category) {
            $tree .= "[#{$category->getId()}] {$category->getName()}";
            $tree .= " - Articles: " . count($this->getArticlesByCategory($category->getId())) . "\n";
        }

        return $tree;
    }

    public function displayDataSummary(): string
    {
        $output = "RESUME DES DONNEES\n";
        $output .= str_repeat("=", 40) . "\n";

        $stats = $this->getStats();
        $output .= "Utilisateurs: {$stats['users']}\n";
        $output .= "Articles: {$stats['articles']} ";
        $output .= "({$stats['published_articles']} publiés, ";
        $output .= "{$stats['draft_articles']} brouillons)\n";
        $output .= "Catégories: {$stats['categories']}\n";
        $output .= "Commentaires: {$stats['comments']}\n\n";

        $roles = ['admin' => 0, 'editor' => 0, 'author' => 0];
        foreach ($this->users as $user) {
            $roles[$user->getRole()]++;
        }

        $output .= "Utilisateurs par rôle:\n";
        $output .= "- Administrateurs: {$roles['admin']}\n";
        $output .= "- Éditeurs: {$roles['editor']}\n";
        $output .= "- Auteurs: {$roles['author']}\n\n";

        $output .= "Articles par catégorie:\n";
        foreach ($this->categories as $category) {
            $articleCount = count($this->getArticlesByCategory($category->getId()));
            if ($articleCount > 0) {
                $output .= "- {$category->getName()}: {$articleCount}\n";
            }
        }

        return $output;
    }
}
