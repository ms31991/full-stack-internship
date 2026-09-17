<?php

class Project {
    public string $title;
    public array $tasks = [];

    public function __construct(string $title) {
        $this->title = $title;
    }

    public function addTask(Task $task): void {
        $this->tasks[] = $task;
    }

    public function listTasks(): void {
        foreach ($this->tasks as $task) {
            echo "- {$task->name} [{$task->status}]\n";
        }
    }
}