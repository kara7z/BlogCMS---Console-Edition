<?php
class Comment
{
    private static $nextId = 1;

    private int $id;
    private string $content;
    private int $user_id;
    private int $article_id;
    private DateTime $created_at;
    private DateTime $updated_at;

    public function __construct($content, $user_id, $article_id)
    {
        $this->id = self::$nextId++;
        $this->content = $content;
        $this->user_id = $user_id;
        $this->article_id = $article_id;
        $this->created_at = new DateTime();
        $this->updated_at = new DateTime();
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }
    public function getContent(): string
    {
        return $this->content;
    }
    public function getUserId(): int
    {
        return $this->user_id;
    }
    public function getArticleId(): int
    {
        return $this->article_id;
    }
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }
    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }

    public function getCreatedAtFormatted(): string
    {
        return $this->created_at->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtFormatted(): string
    {
        return $this->updated_at->format('d/m/Y H:i:s');
    }

    // Setters
    public function setContent(string $content): void
    {
        $this->content = $content;
        $this->updated_at = new DateTime();
    }

    public function getCommentInfo(): string
    {
        return sprintf(
            "COMMENTAIRE #%d\n" .
                "Contenu: %s\n" .
                "Utilisateur ID: %d\n" .
                "Article ID: %d\n" .
                "Poste le: %s\n" .
                "Derniere modification: %s\n",
            $this->id,
            $this->content,
            $this->user_id,
            $this->article_id,
            $this->getCreatedAtFormatted(),
            $this->getUpdatedAtFormatted()
        );
    }

    public function getShortInfo(): string
    {
        return sprintf(
            "[#%d] %s... (Poste le: %s)",
            $this->id,
            substr($this->content, 0, 30),
            $this->getCreatedAtFormatted()
        );
    }

    public function update(string $newContent): void
    {
        $this->setContent($newContent);
    }

    public function delete(): void
    {
        $this->content = "[Commentaire supprime]";
        $this->updated_at = new DateTime();
    }
}
