<?php
 include('config.php');

?>

<html>

    <head>
        <title>X Manager - Add Task</title>
    </head>

    <body>

        <h1>X Manager</h1>

        <p>
            <?php

                if(isset($_SESSION['add_fail']))
                {
                    echo $_SESSION['add_fail'];

                    unset($_SESSION['add_fail']);
                }

            ?>
        </p>

        <a href="<?php echo SITEURL; ?>">Home</a>

        <h3>Add Task</h3>

        <form method="POST" action="">

            <table>
                <tr>
                    <td>Task Name:</td>
                    <td><input type="text" name="task_name" placeholder="Type Your Task Name" required="required"></td>
                </tr>

                <tr>
                    <td>Task Description: </td>
                    <td><textarea name="task_description" placeholder="Type Task Description"></textarea></td>
                </tr>

                <tr>
                    <td>Select List: </td>
                    <td>
                        <select name="list_id">
                            <?php

                                $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
                                IF (!$db) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                $db_select = mysqli_select_db($db, DB_NAME) or die(mysqli_error());

                                $sql = "SELECT * FROM tbl_lists";

                                $dofuck = mysqli_query($db, $sql);

                                if($dofuck==true)
                                {
                                    $cr = mysqli_num_rows($dofuck);
                                    
                                    //if data in db display in dropdown else display none
                                    if ($cr>0)
                                    {
                                        while($row=mysqli_fetch_assoc($dofuck))
                                        {
                                            $list_id = $row['list_id'];
                                            $list_name = $row['list_name'];
                                            ?>

                                            <option value="<?php echo $list_id; ?>"><?php echo $list_name; ?></option>
                                            
                                            <?php
                                        }    
                                    }
                                    else
                                    {
                                        ?>
                                        <option value="0">None</option>
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
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Deadline:</td>
                    <td><input type="date" name="deadline"></td>
                </tr>

                <tr>
                    <td><input type="submit" name="submit" value="Submit" /></td>
                </tr>
            </table>

        </form>

    </body>

</html>

<?php

    if(isset($_POST['submit']))
    {
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
        $list_id = $_POST['list_id'];
        $priority = $_POST['priority'];
        $deadline = $_POST['deadline'];

        $db2 = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        IF (!$db) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $db_select2 = mysqli_select_db($db2, DB_NAME) or die(mysqli_error());

        $sql2 = "INSERT INTO tbl_tasks SET
            task_name = '$task_name',
            task_description = '$task_description',
            list_id = '$task_name',
            priority = '$priority',
            deadline = '$deadline'
        ";

        $dofuck2 = mysqli_query($db2, $sql2);

        if($dofuck2==true)
        {
            $_SESSION['add'] = "Task Added Successfully";

            header('location:'.SITEURL);
        }
        else
        {
            $_SESSION['add_fail'] = "Task Add Failed";

            header('location:'.SITEURL.'addtask.php');
        }

    }



?>