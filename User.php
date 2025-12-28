<?php
class User
{
    private static $nextId = 1;

    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private string $role;
    private DateTime $createAt;
    private DateTime $lastLogin;

    public function __construct($username, $email, $password, $role)
    {
        $this->id = self::$nextId++;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->createAt = new DateTime();
        $this->lastLogin = new DateTime();
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }
    public function getUsername(): string
    {
        return $this->username;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getRole(): string
    {
        return $this->role;
    }
    public function getCreateAt(): DateTime
    {
        return $this->createAt;
    }
    public function getLastLogin(): DateTime
    {
        return $this->lastLogin;
    }

    public function getCreateAtFormatted(): string
    {
        return $this->createAt->format('d/m/Y H:i:s');
    }

    public function getLastLoginFormatted(): string
    {
        return $this->lastLogin->format('d/m/Y H:i:s');
    }

    // Setters
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    public function setRole(string $role): void
    {
        $this->role = $role;
    }
    public function setLastLogin(): void
    {
        $this->lastLogin = new DateTime();
    }

    // Permissions
    public function canCreateArticle(): bool
    {
        return in_array($this->role, ['author', 'editor', 'admin']);
    }

    public function canEditArticle($articleAuthorId): bool
    {
        if ($this->role == 'admin' || $this->role == 'editor') {
            return true;
        }
        if ($this->role == 'author' && $this->id == $articleAuthorId) {
            return true;
        }
        return false;
    }

    public function canDeleteArticle($articleAuthorId): bool
    {
        return $this->canEditArticle($articleAuthorId);
    }

    public function canCreateCategory(): bool
    {
        return in_array($this->role, ['editor', 'admin']);
    }

    public function canManageUsers(): bool
    {
        return $this->role == 'admin';
    }

    public function canModerateComments(): bool
    {
        return in_array($this->role, ['editor', 'admin']);
    }

    public function canPublishArticle(): bool
    {
        return in_array($this->role, ['author', 'editor', 'admin']);
    }

    public function getUserInfo(): string
    {
        return sprintf(
            "UTILISATEUR #%d\n" .
                "Nom: %s\n" .
                "Email: %s\n" .
                "Role: %s\n" .
                "Cree le: %s\n" .
                "Derniere connexion: %s\n",
            $this->id,
            $this->username,
            $this->email,
            ucfirst($this->role),
            $this->getCreateAtFormatted(),
            $this->getLastLoginFormatted()
        );
    }

    public function getShortInfo(): string
    {
        return "[#{$this->id}] {$this->username} ({$this->role})";
    }
}
