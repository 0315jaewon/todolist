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

$task = $_POST['task'];
$pass = $_POST['password'];
if (isset($task) && isset($pass)) {
    $file = fopen('tasks.txt', "a");
    $flen = sizeof(file('tasks.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
    if (password_verify($pass, $correct_pass) && $flen < 5) {
        fwrite($file, $task . "\n");
    }
    fclose($file);
    header('Location: index.php');
    exit;
}
?>