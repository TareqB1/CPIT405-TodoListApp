<?php 
// Iterate through a list of ids of the todo items
function mark_as_done($checkBoxList) {
    foreach($checkBoxList as $value) {
        // create a prepared update statement
        $update_statement = $GLOBALS['conn']->prepare("UPDATE tasks SET done = 1 WHERE id = ?");
        if($update_statement) {
            $update_statement->bind_param("s", $value);
            if (!$update_statement->execute()) {
                print_r('Error executing MySQL update statement: ' . $update_statement->err);
                return;
            }
            // close the prepared statement
            $update_statement->close();
        }
    }
}

// mark all tasks as done
function mark_all_as_done() {
    $update_all_statement = $GLOBALS['conn']->prepare("UPDATE tasks SET done = 1");
    if($update_all_statement) {
        if (!$update_all_statement->execute()) {
            print_r('Error executing MySQL update statement: ' . $update_all_statement->error);
        }
        $update_all_statement->close();
    } else {
        print_r('Error preparing MySQL update statement');
    }
}

// Check if the btn is set and call the function
if (isset($_POST['mark_all_done_btn'])) {
    mark_all_as_done();
}
?>

