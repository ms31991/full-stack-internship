<?php

class Task {
    public string $name;
    public string $status;

    public function __construct(string $name, string $status = "pending") {
        $this->name = $name;
        $this->status = $status;
    }

    public function complete(): void {
        $this->status = "completed";
    }
}