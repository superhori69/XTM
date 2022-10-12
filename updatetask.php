<?php

include('config.php');

//Get val of selected list

if(isset($_GET['task_id']))
{
    $task_id = $_GET['task_id'];

    $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
    IF (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $db_select = mysqli_select_db($db, DB_NAME) or die(mysqli_error());

    $sql = "SELECT * FROM tbl_tasks WHERE task_id=$task_id";

    $dofuck = mysqli_query($db, $sql);

    if($dofuck==true)
    {
        //Get data val from db
        $val = mysqli_fetch_assoc($dofuck);

        //printing $val array
        //print_r($val);

        //Create Individual Var to save data
        $task_name = $val['task_name'];
        $task_description = $val['task_description'];
        $list_id = $val['list_id'];
        $priority = $val['priority'];
        $deadline = $val['deadline'];
    }
    else
    {
        header('location'.SITEURL.'updatetask.php');
    }
}

?>

    <html>
    <head>
        <title>X Manager - Update</title>
        <link rel="stylesheet" href="<?php echo SITEURL?>assets/style.css"/>
    </head>

    <body>
    <div class="wrapper">
    <h1>X Manager</h1>

    <div class="menu">

        <a href="<?php echo SITEURL; ?>">Home</a>

    </div>

    <h3>Update Task</h3>

    <form method="POST" action="">

        <table>
            <tr>
                <td>Task Name: </td>
                <td><input type="text" name="task_name" value="<?php echo $task_name; ?>" required="required"/></td>
            </tr>

            <tr>
                <td>Task Description: </td>
                <td>
                        <textarea name="task_description">
                            <?php echo $task_description; ?>
                        </textarea>
                </td>
            </tr>

            <tr>
                <td>Select List: </td>
                <td>
                    <select name="list_id">
                        <?php

                            $db3 = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());

                            $db_select3 = mysqli_select_db($db3, DB_NAME) or die(mysqli_error());

                            $sql3 = "SELECT * FROM tbl_lists";

                            $dofuck3 = mysqli_query($db3, $sql3);

                            if($dofuck3==true)
                            {
                                $cr3 = mysqli_num_rows($dofuck3);

                                if($cr3>0)
                                {
                                    while($row3=mysqli_fetch_assoc($dofuck3))
                                    {
                                        $list_id_hentai = $row3['list_id'];
                                        $list_name = $row3['list_name'];
                                        ?>
                                        <option <?php if($list_id_hentai==$list_id){echo "selected='selected'";} ?> value="<?php echo $list_id_hentai; ?>"><?php echo $list_name; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option <?php if($list_id==0){echo "selected='selected'";} ?> value="0">None</option>
                                    <?php
                                }
                            }

                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Priority</td>
                <td>
                    <select name="priority">
                        <option <?php if($priority=="High"){echo "selected='selected'";} ?> value="High">High</option>
                        <option <?php if($priority=="Medium"){echo "selected='selected'";} ?> value="Medium">Medium</option>
                        <option <?php if($priority=="Low"){echo "selected='selected'";} ?> value="Low">Low</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Deadline:</td>
                <td><input type="date" name="deadline" value="<?php echo $deadline; ?>"></td>
            </tr>

            <tr>
                <td><input class="btn-primary" type="submit" name="submit" value="Update"></td>
            </tr>
        </table>

    </form>
    </div>
    </body>


    </html>


<?php

//Check whether the form is Updated or not
if(isset($_POST['submit'])) {
    //echo "Form Updated";

    // Get values from form and save in var.

    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_description'];
    $list_id = $_POST['list_id'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];

    // Database connection

    $db2 = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $db_select2 = mysqli_select_db($db2, DB_NAME);

    // Sql query data insertion
    $sql2 = "UPDATE tbl_tasks SET
                    task_name = '$task_name',
                    task_description = '$task_description',
                    list_id = '$list_id',
                    priority = '$priority',
                    deadline = '$deadline'
                    WHERE task_id=$task_id
                ";

    // Execute query

    $dofuck2 = mysqli_query($db2, $sql2);

    // Check query fail or pass
    if ($dofuck2 == true) {
        //Data pass
        //echo "Data Pass";

        //Create session var to display message
        $_SESSION['update_task'] = "Task Updated successfully";

        // Back to Manage List
        header('location:' . SITEURL);

    } else {
        //Data Fail
        //echo "Data Fail";

        //Create session var to display message
        $_SESSION['update_task_fail'] = "Failed to Update Task";

        // Reload because of failure
        header('location' . SITEURL);
    }

}

?>