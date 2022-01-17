<?php

require __DIR__ . '/app/autoload.php';

require __DIR__ . '/views/header.php';
checkUserLoginStatus();
?>

<?php

$lists = fetchAllLists($database);
$tasks = fetchAllTasks($database);

?>
<div class="d-flex flex-row justify-content-center">

    <div class=" p-2"> <button type="button" id="showCreateTask" class="btn btn-link"><b>Create new sticky</b></button>
    </div>
    <div class="p-2">
        <button type="button" id="showCreateList" class="btn btn-link"><b>Create new list</b></button>
    </div>
    <div class="p-2">
        <button type="button" id="showEditList" class="btn btn-link"><b>Edit lists</b></button>
    </div>
</div>


<div class="tasksParent">
    <div class=" createTask">

        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 stickyNote">
                <div class="card-body">
                    <div class="container">
                        <h2 class="permanentMarker">Create a new sticky</h2>

                        <!--update task form-->
                        <form action="/app/posts/store.php" method="POST">
                            <div class="controls">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="taskName"><b>Title</b></label>
                                        <input class="form-control" type="text" id="taskName" name="taskName" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="taskDeadline"><b>Deadline</b></label>
                                        <input class="form-control" type="date" id="taskDeadline" name="taskDeadline">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">

                                        <label for="taskDescription"><b>description</b></label>
                                        <textarea class="form-control" id="taskDescription" name="taskDescription" required></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="listSelection"><b>Add to a list?</b></label>
                                        <select class="form-control" id="listSelection" name="listSelection">
                                            <option disabled selected value>Add to list</option>
                                            <?php
                                            for ($i = 0; $i < count($lists); $i++) : ?>
                                                <option value="<?php echo $lists[$i]['id'] ?>"><?php echo htmlspecialchars($lists[$i]['title']) ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary margin10px">Create Sticky</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4 editTask stickyNote hidden">
            <div class="card-body">
                <div class="container">
                    <h2 id="editTaskTitle" class="permanentMarker"></h2>
                    <!--update task form-->
                    <form action="/app/posts/update.php" method="POST">
                        <div class="controls">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="editTaskName"><b>Title</b></label>
                                    <input class="form-control" type="text" id="editTaskName" name="editTaskName" value="" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="editTaskDeadline"><b>Deadline</b></label>
                                    <input class="form-control" type="date" id="editTaskDeadline" name="editTaskDeadline" value="">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <label for="editTaskDescription"><b>Description</b></label>
                                    <textarea class="form-control" id="editTaskDescription" name="editTaskDescription"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="editListSelection"><b>List</b></label>
                                    <select class="form-control" id="editListSelection" name="editListSelection">
                                        <option disabled selected value><b>Move Sticky to list:</b></option>
                                        <option value="removeFromList">(Remove from current list)</option>
                                        <?php
                                        for ($i = 0; $i < count($lists); $i++) : ?>
                                            <option value="<?php echo $lists[$i]['id'] ?>"><?php echo htmlspecialchars($lists[$i]['title']) ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="editTaskCompleted"><b>Complete/incomplete</b></label>
                                    <select class="form-control" id="editTaskCompleted" name="editTaskCompleted">
                                        <option disabled selected value>Mark as:</option>
                                        <option value="complete">Complete</option>
                                        <option value="incomplete">Incomplete</option>
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" id="editTaskId" name="editTaskId" class="editTaskId" value="">
                            <div class="col-sm margin10px">
                                <button type="submit" class="btn btn-primary">Update Sticky</button>
                    </form>
                    <!--cancel edit/delete task (will hide the edit and cancel task forms)-->
                    <button type="button" class=" cancel btn btn-secondary margin10px">Cancel</button>
                </div>
                <!--delete task form-->

                <form action="/app/posts/delete.php" method="POST">
                    <input type="hidden" id="taskIdToDelete" name="taskIdToDelete" class="editTaskId" value="">
                    <div class="col-sm"><button type="submit" class="editTaskId btn btn-danger" value="" onclick="return confirm('Are you sure? This cannot be undone.')">Delete sticky</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>



<!--create list form-->
<div class="row">
    <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4 stickyNote createList hidden">
            <div class="card-body">
                <div class="container">
                    <h2 class="permanentMarker">Create a new list</h2>
                    <form action="/app/posts/store.php" method="POST">


                        <label for="listName"><b>Enter a list name</b></label>
                        <input type="text" class="form-control" id="listName" name="listName" required>


                        <button type="submit" class="btn btn-primary margin10px">Create List</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- form for selecting a list to edit -->
<div class="row">
    <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4 stickyNote selectListToEdit hidden">
            <div class="card-body">
                <div class="container">
                    <h2 class="permanentMarker">Edit list</h2>
                    <form>
                        <label for="listIdToUpdate"><b>Select the list you want to edit</b></label>
                        <select id="listIdToUpdate" name="listIdToUpdate" class="form-control">
                            <option disabled selected value>Your lists:</option>
                            <?php
                            for ($i = 0; $i < count($lists); $i++) : ?>
                                <option value="<?php echo $lists[$i]['id'] ?>"><?php echo htmlspecialchars($lists[$i]['title']) ?></option>
                            <?php endfor; ?>
                        </select>
                        <button type="button" id="editList" class="btn btn-primary margin10px" value="">Edit list</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- form for updating / deleting a list -->
<div class="row">
    <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4 stickyNote editListForm hidden">
            <div class="card-body">
                <div class="container">
                    <h2 id="listTitle" class="permanentMarker"></h2>
                    <form action="/app/posts/update.php" method="POST">
                        <input type="hidden" id="listIdToUpdate" name="listIdToUpdate" class="editListId" value="">
                        <label for="editListName"><b>List name</b></label>
                        <input type="text" id="editListName" class="form-control" name="editListName" value="" required>
                        <button type="submit" class="btn btn-primary margin10px">Update list</button>
                    </form>
                    <hr>
                    <h2 class="permanentMarker">Delete list</h2>
                    <form action="/app/posts/delete.php" method="POST">
                        <input type="hidden" id="listIdToDelete" name="listIdToDelete" class="editListId" value="">
                        <label for="alsoDeleteTasks"><b>Optional:</b> Also delete stickies associated with the list</label>
                        <input type="checkbox" id="alsoDeleteTasks" class="form-check-label" name=" alsoDeleteTasks"><br>
                        <button type="submit" class="btn btn-danger margin10px" onclick="return confirm('Are you sure? This cannot be undone.')">Delete list</button>
                    </form>
                    <button type="button" class="cancel btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
require __DIR__ . '/views/successmsg.php';
require __DIR__ . '/views/errormsg.php';
require __DIR__ . '/views/warningmsg.php';
?>

<form action="wunderlists.php" method="GET">
    <div class="d-flex justify-content-end">
        <div class="p-2">
            <select class="form-control" name="show">
                <option disabled selected value>Show only:</option>
                <option value="completed" name="completed">Completed</option>
                <option value="incomplete" name="incomplete">Incomplete</option>
                <option value="toDoToday" name="toDoToday">To be completed today</option>
                <option value="showAll" name="showAll">Show All</option>
            </select>
        </div>

        <div class="p-2">

            <select class="form-control" name="showListItemsOnly">
                <option disabled selected value>Filter by list:</option>
                <option value="<?php null ?>" name="<?php null ?>">Show stickiess without a list</option>
                <?php
                for ($i = 0; $i < count($lists); $i++) : ?>
                    <option value="<?php echo $lists[$i]['id'] ?>" name="<?php echo htmlspecialchars($lists[$i]['title']); ?>"><?php echo htmlspecialchars($lists[$i]['title']); ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="p-2">
            <select class="form-control" name="sort">
                <option disabled selected value>Sort by:</option>
                <option value="deadline" name="deadline">Deadline</option>
                <option value="task" name="task">Title</option>
                <option value="completed" name="completed">Completed</option>
            </select>
        </div>
        <div class="p-2">
            <button type="submit" class="btn btn-primary">Sort</button>
        </div>
    </div>
    <div><button type="button" id="changeFont" class="btn btn-link">Reader Friendly mode</button></div>
</form>


<?php
// if the user picks a "sort by" option then the usort function will compare the value selected and return the array sorted by that value.
if (isset($_GET['sort'])) {
    usort($tasks, function ($sortBy, $sorted) {
        $value = $_GET['sort'];
        if ($_GET['sort'] === 'completed' || $_GET['sort'] === 'deadline') {
            $sorted = $sorted[$value] <=> $sortBy[$value];
        } else {
            $sorted = $sortBy[$value] <=> $sorted[$value];
        }
        return $sorted;
    });
}




// if-statements that manipulate the tasks array to filter by complete/incomplete/today's date. Because showAll is not defined it will return the full list by default.
if (isset($_GET['show'])) {
    if ($_GET['show'] === 'completed') {
        $tasksCompleted = array_filter($tasks, function ($var) {
            return ($var['completed'] == '1');
        });

        $showResult = array_values($tasksCompleted);
        $tasks = $showResult;
    } elseif ($_GET['show'] === 'incomplete') {
        $tasksIncomplete = array_filter($tasks, function ($var) {
            return ($var['completed'] == '0');
        });

        $showResult = array_values($tasksIncomplete);
        $tasks = $showResult;
    } elseif ($_GET['show'] === 'toDoToday') {
        $tasksToday = array_filter($tasks, function ($var) {
            return ($var['deadline'] == date("Y-m-d"));
        });

        $showResult = array_values($tasksToday);
        $tasks = $showResult;
    }
}
// filter by list ID
if (isset($_GET['showListItemsOnly'])) {
    $tasksWithListId = array_filter($tasks, function ($var) {
        return ($var['list_id'] == $_GET['showListItemsOnly']);
    });

    $showResult = array_values($tasksWithListId);
    $tasks = $showResult;
}



?>

<div class="corkBoard">
    <div id="taskContents" class="container reenieFont">
        <div class="row">
            <?php
            for ($i = 0; $i < count($tasks); $i++) : ?>
                <div class="stickyNote text-wrap text-break">
                    <div class="col-sm permanentMarker margin10px"><b><span class="title"><?php echo htmlspecialchars($tasks[$i]['task']) ?></span></b></div>
                    <div class="col-sm"><span class="description"><?php echo htmlspecialchars($tasks[$i]['description']) ?></span></div>
                    <div class="col-sm"><b>Deadline:</b> <span class="deadline"><?php echo htmlspecialchars($tasks[$i]['deadline']) ?></div>
                    <div class="col-sm"><b>Completed:</b>
                        <?php
                        if ($tasks[$i]['completed'] === '1') {
                            echo 'Yes';
                        } else {
                            echo 'No';
                        } ?>
                    </div>
                    <div class="col-sm"><b>Belongs to list: </b><span class="list" id="<?php echo htmlspecialchars($tasks[$i]['list_id']) ?>"><?php echo htmlspecialchars($tasks[$i]['title']) ?></span></div>

                    <button type="button" class="editTaskButton" id="<?php echo $tasks[$i]['task_id'] ?>">Edit</button>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>
<script src="/assets/scripts/wunderlist.js"></script>
<?php
require __DIR__ . '/views/footer.php';
