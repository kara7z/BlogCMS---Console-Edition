<?php
class Article
{
    private static $nextId = 1;

    private int $id;
    private string $title;
    private string $content;
    private string $status;
    private User $author;
    private DateTime $created_at;
    private DateTime $updated_at;
    private ?DateTime $published_at = null;
    private array $categories = [];
    private array $comments = [];

    public function __construct($title, $content, User $author)
    {
        $this->id = self::$nextId++;
        $this->title = $title;
        $this->content = $content;
        $this->status = 'draft';
        $this->author = $author;
        $this->created_at = new DateTime();
        $this->updated_at = new DateTime();
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getContent(): string
    {
        return $this->content;
    }
    public function getStatus(): string
    {
        return $this->status;
    }
    public function getAuthor(): User
    {
        return $this->author;
    }
    public function getCategories(): array
    {
        return $this->categories;
    }
    public function getComments(): array
    {
        return $this->comments;
    }
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }
    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }
    public function getPublishedAt(): ?DateTime
    {
        return $this->published_at;
    }

    public function getCreatedAtFormatted(): string
    {
        return $this->created_at->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtFormatted(): string
    {
        return $this->updated_at->format('d/m/Y H:i:s');
    }

    public function getPublishedAtFormatted(): string
    {
        return $this->published_at ? $this->published_at->format('d/m/Y H:i:s') : 'Non publie';
    }

    // Setters
    public function setTitle(string $title): void
    {
        $this->title = $title;
        $this->updated_at = new DateTime();
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
        $this->updated_at = new DateTime();
    }

    public function setStatus(string $status): void
    {
        $oldStatus = $this->status;
        $this->status = $status;
        $this->updated_at = new DateTime();

        if ($status == 'published' && $oldStatus != 'published') {
            $this->published_at = new DateTime();
        }
    }

    public function ArticleInfo(): string
    {
        $info = "ARTICLE #{$this->id}\n";
        $info .= "Titre: {$this->title}\n";
        $info .= "Statut: " . ucfirst($this->status) . "\n";
        $info .= "Auteur: " . $this->author->getUsername() . "\n";
        $info .= "Cree le: " . $this->getCreatedAtFormatted() . "\n";
        $info .= "Derniere modification: " . $this->getUpdatedAtFormatted() . "\n";

        if ($this->published_at) {
            $info .= "Publie le: " . $this->getPublishedAtFormatted() . "\n";
        }

        if (!empty($this->categories)) {
            $info .= "Categories: ";
            $catNames = [];
            foreach ($this->categories as $category) {
                $catNames[] = $category->getName();
            }
            $info .= implode(', ', $catNames) . "\n";
        }

        $info .= "Contenu:\n" . wordwrap($this->content, 60) . "\n";

        return $info;
    }

    public function getShortInfo(): string
    {
        $statusText = [
            'draft' => '[Brouillon]',
            'published' => '[Publie]',
            'archived' => '[Archive]'
        ];

        return sprintf(
            "%s #%d - %s - %s",
            $statusText[$this->status] ?? '[?]',
            $this->id,
            $this->title,
            $this->author->getUsername()
        );
    }

    public function addCategory(Category $category): void
    {
        if (!in_array($category, $this->categories, true)) {
            $this->categories[] = $category;
            $this->updated_at = new DateTime();
        }
    }

    public function removeCategory(Category $category): void
    {
        $key = array_search($category, $this->categories, true);
        if ($key !== false) {
            unset($this->categories[$key]);
            $this->categories = array_values($this->categories);
            $this->updated_at = new DateTime();
        }
    }

    public function publish(): void
    {
        $this->setStatus('published');
    }

    public function unpublish(): void
    {
        $this->setStatus('draft');
        $this->published_at = null;
    }

    public function archive(): void
    {
        $this->setStatus('archived');
    }

    public function addComment(Comment $comment): void
    {
        $this->comments[] = $comment;
    }

    public function removeComment(Comment $comment): void
    {
        $key = array_search($comment, $this->comments, true);
        if ($key !== false) {
            unset($this->comments[$key]);
            $this->comments = array_values($this->comments);
        }
    }
}
