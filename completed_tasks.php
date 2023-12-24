<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" rel="stylesheet" href="./style.css">
    <title>Completed Tasks</title>
</head>
<body>
    <?php 
    require_once('./db_connection.php');

    // fetch and display completed tasks
    function get_completed_todos()
    {
        $get_completed_tasks_query = "SELECT id, task, date_added FROM tasks WHERE done = 1 ORDER BY date_added DESC;";
        $response = $GLOBALS['conn']->query($get_completed_tasks_query);
        
        if ($response && $response->num_rows > 0) {
            echo '<ul id="completed-list">';
            while ($row = $response->fetch_assoc()) {
                echo "<li>".$row["task"]." (Added on: ".$row["date_added"].")</li>";
            }
            echo '</ul>';
        } else {
            echo '<h2>No completed tasks!</h2>';
        }
    }

    echo "<h1>Completed Tasks</h1>";
    get_completed_todos(); 
    ?>

    <a href="index.php">Back to ToDo List</a> 
</body>
</html>