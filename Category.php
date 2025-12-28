<?php

class Category
{
    private static $nextId = 1;

    private int $id;
    private string $name;
    private string $description;
    private ?int $parentId;
    private array $children = [];
    private array $articles = [];
    private DateTime $createdAt;

    public function __construct($name, $description = '', $parentId = null)
    {
        $this->id = self::$nextId++;
        $this->name = $name;
        $this->description = $description;
        $this->parentId = $parentId;
        $this->createdAt = new DateTime();
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getParentId(): ?int
    {
        return $this->parentId;
    }
    public function getChildren(): array
    {
        return $this->children;
    }
    public function getArticles(): array
    {
        return $this->articles;
    }
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getCreatedAtFormatted(): string
    {
        return $this->createdAt->format('d/m/Y H:i:s');
    }

    // Setters
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    public function setParentId(?int $parentId): void
    {
        $this->parentId = $parentId;
    }

    public function addSubCategory(Category $category): void
    {
        $category->setParentId($this->id);
        $this->children[] = $category;
    }

    public function addArticle(Article $article): void
    {
        if (!in_array($article, $this->articles, true)) {
            $this->articles[] = $article;
        }
    }

    public function removeArticle(Article $article): void
    {
        $key = array_search($article, $this->articles, true);
        if ($key !== false) {
            unset($this->articles[$key]);
            $this->articles = array_values($this->articles);
        }
    }

    public function getCategoryInfo(): string
    {
        $info = "CATEGORIE #{$this->id}\n";
        $info .= "Nom: {$this->name}\n";

        if ($this->description) {
            $info .= "Description: {$this->description}\n";
        }

        if ($this->parentId) {
            $info .= "Parent ID: {$this->parentId}\n";
        } else {
            $info .= "Type: Categorie racine\n";
        }

        $info .= "Creee le: {$this->getCreatedAtFormatted()}\n";
        $info .= "Sous-categories: " . count($this->children) . "\n";
        $info .= "Articles: " . count($this->articles) . "\n";

        return $info;
    }

    public function getTreeView($level = 0): string
    {
        $indent = str_repeat("  ", $level);
        $tree = $indent . "|- [#{$this->id}] {$this->name}";

        if (!empty($this->children)) {
            $tree .= ":\n";
            foreach ($this->children as $child) {
                $tree .= $child->getTreeView($level + 1);
            }
        } else {
            $tree .= " (Articles: " . count($this->articles) . ")\n";
        }

        return $tree;
    }
}
