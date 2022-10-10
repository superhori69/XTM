<?php
include('config.php');

    //check list_id assign

    if(isset($_GET['list_id']))
    {
        //delete list
        $list_id = $_GET['list_id'];

        $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        IF (!$db) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $db_select = mysqli_select_db($db, DB_NAME);

        $sql = "DELETE FROM tbl_lists WHERE list_id=$list_id";

        $dofuck = mysqli_query($db, $sql);

        if($dofuck==true)
        {
            //Data pass
            //echo "Data Pass";

            //Create session var to display message
            $_SESSION['delete'] = "List Deleted Successfully";

            // Back to Manage List
            header('location:'.SITEURL.'managelist.php');

        }
        else
        {
            //Data Fail
            //echo "Data Fail";

            //Create session var to display message
            $_SESSION['delete_fail'] = "Failed to Add List";

            // Reload because of failure
            header('location'.SITEURL.'managelist.php');
        }
    }
    else
    {
        //redirect to manage list
        header('location'.SITEURL.'manage-list.php');
    }

    //echo "Delete List Page"

    $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
    IF (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $db_select = mysqli_select_db($db, DB_NAME);

    $sql = "DELETE FROM tbl_lists WHERE list_id=";

?>