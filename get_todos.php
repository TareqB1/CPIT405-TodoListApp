<?php 
function get_all_todos()
{
    $today = date("Y-m-d");
    $yesterday = date("Y-m-d", strtotime("-1 day"));
    $oneWeekAgo = date("Y-m-d", strtotime("-1 week"));

    $get_all_tasks_query = "SELECT id, task, date_added, done FROM tasks WHERE done = 0 ORDER BY date_added DESC;";
    $response = $GLOBALS['conn']->query($get_all_tasks_query);

    if ($response && $response->num_rows > 0) {
        $currentGroup = null;
        while ($row = $response->fetch_array()) {
            if ($row["date_added"] == $today) {
                $group = "Today";
            } elseif ($row["date_added"] == $yesterday) {
                $group = "Yesterday";
            } elseif ($row["date_added"] >= $oneWeekAgo) {
                $group = "This Week";
            } else {
                $group = "Older";
            }

            // print a new group header if group changese
            if ($currentGroup !== $group) {
                if ($currentGroup !== null) {
                    echo '</ul>'; 
                }
                echo '<h3>' . $group . '</h3>';
                echo '<ul id="my-list">';
                $currentGroup = $group;
            }

            // display task with checkbox
            echo "<li>".'<input type="checkbox" name="checkBoxList[]" value="'.$row["id"].'"><span>'.$row["task"]."</span></li>";
        }
        echo '</ul>';
    } else {
        echo '<h2>Your ToDo list is empty!</h2>';
    }
}
?>