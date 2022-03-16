<?php
require_once 'User.php';

class Comment
{
    public User $user;
    public string $text;

    public function __construct(User $user, string $text)
    {
        $this->user = $user;
        $this->text = $text;
    }

    public function getText(): string
    {
        return "Registered: 
            {$this->user->getCreatedAtString()}
            {$this->text}
        ";
    }
} 