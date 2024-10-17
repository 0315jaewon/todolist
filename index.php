<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-do list</title>
    <link rel="stylesheet" href="planner.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
</head>
<body>
    <h1>To-do list: </h1>
    <form action="submit.php" method="POST">
        <input type="text" name="task" placeholder="Enter Task" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit" value='add'>Add Task</button>
    </form>
    <ul>
        <?php
        $file = 'tasks.txt';
        if (file_exists($file) && is_readable($file)) {
            $tasks = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($tasks as $index => $task) {
                $completed = strpos($task, '[x]') === 0 ? 'completed' : '';
                $task_text = str_replace('[x] ', '', $task);
                echo"<li>";
                echo "<span class='$completed'>" . htmlspecialchars($task_text) . "</span>";
                echo " 
                    <form action='update.php' method='POST' style='display:inline'>
                        <input type='hidden' name='task_index' value='$index'>
                        <input type='password' name='pass' placeholder='Enter Password' required>
                        <button type='submit' name='action' value='complete'>Complete</button>
                        <button type='submit' name='action' value='remove'>Remove</button>
                    </form>
                </li>";
            }
        }
        ?>
    </ul>



</body>
</html>