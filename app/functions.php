<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}


function fetchAllTasks($database): array
{
    $statement = $database->prepare('SELECT lists.id, title, tasks.id AS task_id, tasks.user_id, tasks.list_id, tasks.task, tasks.description, tasks.deadline, tasks.completed FROM tasks LEFT JOIN lists ON tasks.list_id = lists.id AND tasks.user_id = lists.user_id  WHERE tasks.user_id = :user_id');
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();

    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $tasks;
}

// Hannas kod Hannas kod Hannas kod Hannas kod Hannas kod Hannas kod Hannas kod Hannas kod Hannas kod Hannas kod

//Denna kod hittar allt, men är inte kopplad till rätt user.
function searchTask($database, $search): array
{
    $user = $_SESSION['user']['id'];
    $search = "%$search%";

    $statement = $database->prepare('SELECT lists.id, title, tasks.id AS task_id, tasks.user_id, tasks.list_id, tasks.task,
    tasks.description, tasks.deadline, tasks.completed FROM tasks LEFT JOIN lists ON tasks.list_id = lists.id WHERE (task
    LIKE :search OR description LIKE :search OR title LIKE :search ) AND tasks.user_id = :user_id');

    $statement->bindParam(':search', $search, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $user, PDO::PARAM_INT);
    $statement->execute();

    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $tasks;
}

// Hannas kod Hannas kod Hannas kod Hannas kod Hannas kod Hannas kod Hannas kod Hannas kod Hannas kod Hannas kod

function fetchAllLists($database): array
{
    $statement = $database->prepare('SELECT * FROM lists WHERE user_id = :user_id');
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
    $lists = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $lists;
}

function checkUserLoginStatus(): void
{
    if (is_null($_SESSION['user'])) {
        $_SESSION['errorMsg'] = 'Please log in first.';
        redirect('/login.php');
    }
}

function userAvatar(): string
{
    if (is_null($_SESSION['user']['image'])) {
        $userAvatar = '/uploads/placeholder.jpg';
        return $userAvatar;
    } else {
        return $_SESSION['user']['image'];
    }
}

function showCompletedOnly($database): array
{
    $completed = 1;
    $statement = $database->prepare('SELECT * FROM tasks WHERE user_id = :user_id AND completed = :completed');
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->bindParam(':completed', $completed, PDO::PARAM_BOOL);
    $statement->execute();
    $completedTasks = $statement->fetchAll(PDO::FETCH_DEFAULT);
    return $completedTasks;
}
