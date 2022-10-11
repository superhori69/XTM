<?php
include('config.php');

//check list_id assign

if(isset($_GET['task_id']))
{
    //delete list
    $task_id = $_GET['task_id'];

    $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
    IF (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $db_select = mysqli_select_db($db, DB_NAME);

    $sql = "DELETE FROM tbl_tasks WHERE task_id=$task_id";

    $dofuck = mysqli_query($db, $sql);

    if($dofuck==true)
    {
        //Data pass
        //echo "Data Pass";

        //Create session var to display message
        $_SESSION['delete_task'] = "Task Deleted Successfully";

        // Back to Manage List
        header('location:'.SITEURL);

    }
    else
    {
        //Data Fail
        //echo "Data Fail";

        //Create session var to display message
        $_SESSION['delete_task_fail'] = "Failed to Add List";

        // Reload because of failure
        header('location'.SITEURL);
    }
}
else
{
    //redirect to manage list
    header('location'.SITEURL);
}

//echo "Delete List Page"

?>