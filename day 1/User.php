<?php

class User {
    public string $name;
    public string $email;

    public function __construct(string $name, string $email) {
        $this->name = $name;
        $this->email = $email;
    }

    public function greet(): string {
        return "Hi, i am {$this->name}";
    }
}