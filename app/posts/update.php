<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we update posts in the database.
//I opted to always compare the user ID to the sessions user ID in case the forms were tampered with.

$taskId = $_POST['editTaskId'];

if (isset($_POST['editTaskName'])) {
    $newTask = trim(filter_var($_POST['editTaskName'], FILTER_SANITIZE_STRING));
    $statement = $database->prepare('UPDATE tasks SET task = :task WHERE id = :id AND user_id = :user_id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->bindParam(':task', $newTask, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
}

if (isset($_POST['editTaskDescription'])) {
    $newTaskDescription = trim(filter_var($_POST['editTaskDescription'], FILTER_SANITIZE_STRING));
    $statement = $database->prepare('UPDATE tasks SET description = :description WHERE id = :id AND user_id = :user_id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->bindParam(':description', $newTaskDescription, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
}

if (isset($_POST['editTaskDeadline'])) {
    $newTaskDeadline = trim(filter_var($_POST['editTaskDeadline'], FILTER_SANITIZE_STRING));
    $statement = $database->prepare('UPDATE tasks SET deadline = :deadline WHERE id = :id AND user_id = :user_id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->bindParam(':deadline', $newTaskDeadline, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
}

if (isset($_POST['editListSelection'])) {
    $newListId = trim(filter_var($_POST['editListSelection'], FILTER_SANITIZE_STRING));
}
if ($newListId === 'removeFromList') {
    $newListId = null;
    $statement = $database->prepare('UPDATE tasks SET list_id = :list_id WHERE id = :id AND user_id = :user_id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->bindParam(':list_id', $newListId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
} else {
    //have to convert string to integer
    $newListIdInt = (int)$newListId;
    $statement = $database->prepare('UPDATE tasks SET list_id = :list_id WHERE id = :id AND user_id = :user_id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->bindParam(':list_id', $newListIdInt, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
}


if (isset($_POST['editTaskCompleted'])) {
    if (($_POST['editTaskCompleted'] === 'complete')) {
        $completed = 1;
        $statement = $database->prepare('UPDATE tasks SET completed = :completed WHERE id = :id AND user_id = :user_id');
        $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
        $statement->bindParam(':completed', $completed, PDO::PARAM_BOOL);
        $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
        $statement->execute();
    } elseif (($_POST['editTaskCompleted'] === 'incomplete')) {
        $completed = 0;
        $statement = $database->prepare('UPDATE tasks SET completed = :completed WHERE id = :id AND user_id = :user_id');
        $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
        $statement->bindParam(':completed', $completed, PDO::PARAM_BOOL);
        $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
        $statement->execute();
    }
}

$_SESSION['successMsg'] = 'The sticky "' . $_POST['editTaskName'] . '" is updated.';

if (isset($_POST['completeAllTasks'])) {
    $listId = $_POST['completeAllTasks'];
    $completed = 1;
    $statement = $database->prepare('UPDATE tasks SET completed = :completed WHERE list_id = :list_id');
    $statement->bindParam(':list_id', $listId, PDO::PARAM_INT);
    $statement->bindParam(':completed', $completed, PDO::PARAM_BOOL);
    $statement->execute();
}

if (isset($_POST['completeAllTasksOnCorkboard'])) {
    $listId = $_POST['completeAllTasksOnCorkboard'];
    $completed = 1;
    $statement = $database->prepare('UPDATE tasks SET completed = :completed WHERE list_id = :list_id');
    $statement->bindParam(':list_id', $listId, PDO::PARAM_INT);
    $statement->bindParam(':completed', $completed, PDO::PARAM_BOOL);
    $statement->execute();

    $_SESSION['successMsg'] = 'Everything in this list is marked as completed.';
}

if (isset($_POST['editListName'])) {
    $listName = trim(filter_var(($_POST['editListName']), FILTER_SANITIZE_STRING));
    $listId = $_POST['listIdToUpdate'];
    $statement = $database->prepare('UPDATE lists SET title = :title WHERE id = :id AND user_id = :user_id');
    $statement->bindParam(':id', $listId, PDO::PARAM_INT);
    $statement->bindParam(':title', $listName, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
    $_SESSION['successMsg'] = 'The list "' . $_POST['editListName'] . '" is updated.';
    redirect('/wunderlists.php');
}

redirect('/wunderlists.php');
