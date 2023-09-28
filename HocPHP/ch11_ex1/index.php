<?php
//get tasklist array from POST
$task_list = filter_input(INPUT_POST, 'tasklist', 
        FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
if ($task_list === NULL) {
    $task_list = array();
}

//get action variable from POST
$action = filter_input(INPUT_POST, 'action');

//initialize error messages array
$errors = array();

//process
switch( $action ) {
    case 'Add Task':
        $new_task = filter_input(INPUT_POST, 'newtask');
        if (empty($new_task)) {
            $errors[] = 'The new task cannot be empty.';
        } else {
            $task_list[] = $new_task;
        }
        break;
    case 'Delete Task':
        $task_index = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT);
        if ($task_index === NULL || $task_index === FALSE) {
            $errors[] = 'The task cannot be deleted.';
        } else {
            unset($task_list[$task_index]);
            $task_list = array_values($task_list);
        }
        break;
        // case 'Modify Task':
    case 'Modify Task':
        $task_index = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT );
        if($task_index === NULL || $task_index === FALSE){
            $errors[] = 'The task cannot be modified.';
        }else{
            $task_to_modify = $task_list[$task_index];
        }
        break; 
        // case 'Save Changes'
    case 'Save Changes':
        $id = filter_input(INPUT_POST, 'modifiedtaskid', FILTER_VALIDATE_INT);
        $modify_task = filter_input(INPUT_POST, 'modifiedtask');
        if($modify_task == NULL){
            $errors[] = 'Modified Task can not be empty';
        }elseif($id === NULL || $id === FALSE){
            $errors[] = 'The task can not be modify.';
        }else{
            $task_list[$id] = $modify_task;
            $modify_task = '';
        }
        break;
        // case 'Cancel Changes':
    case 'Cancel Changes':
        $modify_task = '';
        break;
        // case 'Promote Task':
    case 'Promote Task':
        $index = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT);
        if($index === NULL || $index === FALSE){
            $errors[] = 'The task can not be promoted';
        }elseif($index == 0){
            $errors[] = 'You can not promote the first task';
        }else{
            $task_value = $task_list[$index];
            $task_prior = $task_list[$index - 1];

            // swap the values; 
            $task_list[$index - 1] = $task_value;
            $task_list[$index] = $task_prior;
        }
        break;
        // case 'Sort Tasks':
    case 'Sort Tasks Ascending':
        sort($task_list);
        break;
    case 'Sort Tasks Descending':
        rsort($task_list);
        break;
}

include('task_list.php');
?>