<?php
    include('config.php');
?>
<html>

    <head>
        <title>X Manager - Home</title>
    </head>

    <body>
        <h1>X Manager</h1>

        <p>
            <?php
            //Check display status
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];

                unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete_task']))
            {
                echo $_SESSION['delete_task'];

                unset($_SESSION['delete_task']);
            }
            if(isset($_SESSION['delete_task_fail']))
            {
                echo $_SESSION['delete_task_fail'];

                unset($_SESSION['delete_task_fail']);
            }
            if(isset($_SESSION['update_task']))
            {
                echo $_SESSION['update_task'];

                unset($_SESSION['update_task']);
            }
            if(isset($_SESSION['update_task_fail']))
            {
                echo $_SESSION['update_task_fail'];

                unset($_SESSION['update_task_fail']);
            }
            ?>
        </p>

        <!-- Menu Start -->
        <div class="Menu">

            <a href="<?php echo SITEURL; ?>">Home</a>

            <a href="#">To Do</a>
            <a href="#">Doing</a>
            <a href="#">Done</a>

            <a href="<?php echo SITEURL; ?>managelist.php">Manage Lists</a>
        </div>
        <!-- Menu End -->

        <!-- Task Start -->

        <div class="all-tasks">

            <a href="<?php echo SITEURL; ?>addtask.php">Add Task</a>

            <table>

                <tr>
                    <th>S.N</th>
                    <th>Task Name</th>
                    <th>Priority</th>
                    <th>Deadline</th>
                    <th>Actions</th>
                </tr>

                <?php

                $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

                $db_select = mysqli_select_db($db, DB_NAME) or die(mysqli_error());

                $sql = "SELECT * FROM tbl_tasks";

                $snipple = 1;

                $dofuck = mysqli_query($db, $sql);

                if($dofuck==true)
                {
                    $cr = mysqli_num_rows($dofuck);

                    if($cr>0)
                    {
                        while($row=mysqli_fetch_assoc($dofuck))
                        {
                            $task_id = $row['task_id'];
                            $task_name = $row['task_name'];
                            $priority = $row['priority'];
                            $deadline = $row['deadline'];
                            ?>

                            <tr>
                                <td><?php echo $snipple++; ?>. </td>
                                <td><?php echo $task_name; ?></td>
                                <td><?php echo $priority; ?></td>
                                <td><?php echo $deadline; ?></td>
                                <td>

                                    <a href="<?php echo SITEURL; ?>updatetask.php?task_id=<?php echo $task_id; ?>">Update </a>

                                    <a href="<?php echo SITEURL; ?>deletetask.php?task_id=<?php echo $task_id; ?>">Delete</a>

                                </td>
                            </tr>

                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <tr>
                            <td colespan="5">No Task Added Tet.</td>
                        </tr>
                        <?php
                    }
                }

                ?>
            </table>

        </div>

    </body>

</html>