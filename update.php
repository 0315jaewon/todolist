<?php

$env_file = __DIR__ . '/.env';
$correct_pass = "";
if (file_exists($env_file) && is_readable($env_file)) {
    $lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), 'PASSWORD=') === 0) {
            $correct_pass = trim(str_replace('PASSWORD=', '', $line));
            break;
        }
    }
}

$file = 'tasks.txt';
$pass = $_POST['pass'];
if (file_exists($file) && is_writable($file) && isset($pass)) {
    $tasks = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $index = $_POST['task_index'];
    $action = $_POST['action'];

    if ($action === 'complete' && isset($tasks[$index]) && password_verify($pass, $correct_pass)) {
        if (strpos($tasks[$index], '[x] ') === 0) {
            $tasks[$index] = str_replace('[x] ', '', $tasks[$index]);
        } else {
            $tasks[$index] = '[x] ' . $tasks[$index];
        }
    } elseif ($action === 'remove' && isset($tasks[$index]) && password_verify($pass, $correct_pass)) {
        unset($tasks[$index]);
    }

    file_put_contents($file, implode("\n", $tasks) . "\n");
}

header('Location: index.php');
exit;
