<?php

require 'User.php';
require 'Task.php';
require 'Project.php';

$user = new User("Meto", "meto@gmail.com");
echo $user->greet() . "\n";

$project = new Project("Task Management System");

$task1 = new Task("Design database");
$task2 = new Task("Build Laravel API");

$project->addTask($task1);
$project->addTask($task2);

$task1->complete();

$project->listTasks();