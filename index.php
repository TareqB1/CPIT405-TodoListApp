<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link type="text/css" rel="stylesheet" href="./style.css">
  <title>My ToDo List App</title>
</head>
  <body>
    <?php 
    // enable mysql error reporting for debugging only
    // $driver = new mysqli_driver();
    // $driver->report_mode = MYSQLI_REPORT_ALL;
    require_once('./db_connection.php');
    require('./insert_todo.php');
    require('./get_todos.php');
    require('./update_todo.php');
    require('./delete_todo.php');
    
    // if the form is submitted by this page
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        // check which button submitted the POST request? add, delete, or mark as done
        if(isset($_POST['add_btn'])) {
            // insert a new todo item
            insert_task($_POST["new_task"]);
        }
        else if (isset($_POST['mark_done_btn'])) {
            // When a checkbox is selected, update the db to mark it as done
            if(!empty($_POST['checkBoxList'])) {
                mark_as_done($_POST['checkBoxList']);
            }
        }
        else if (isset($_POST['mark_all_done_btn'])) {
            // Mark all items as done
            mark_all_as_done();
        }
        else if (isset($_POST['delete_btn'])) {
            // When a checkbox is selected, delete it in the db
            if(!empty($_POST['checkBoxList'])) {
                delete_item($_POST['checkBoxList']);
            }
        }

    }
?>

<div id="content">
        <h1>My ToDo List App</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" name="new_task" id="new-item" placeholder="Add a new item..." />
            <button type="submit" name="add_btn" id="add-btn">Add</button>
            <div class="buttons">
                <button type="submit" class="btn" name="delete_btn">Delete</button>
                <button type="submit" class="btn" name="mark_done_btn">Mark as Done</button>
                <button type="submit" class="btn" name="mark_all_done_btn">Mark All as Done</button>
            </div>
            <?php get_all_todos(); ?>
        </form>
        <a href="completed_tasks.php">View Completed Tasks</a>
    </div>
</body>
</html>