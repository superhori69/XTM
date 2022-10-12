<?php
    include('config.php');


    $list_id_url = $_GET['list_id'];
?>

<html>

    <head>
        <title>X Manager - Home</title>
        <link rel="stylesheet" href="<?php echo SITEURL?>assets/style.css"/>
    </head>

    <body>
    <div class="wrapper">
        <h1>X Manager</h1>

        <div class="Menu">

            <a href="<?php echo SITEURL; ?>">Home</a>

            <?php

            $db2 = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

            $db_select2 = mysqli_select_db($db2, DB_NAME) or die(mysqli_error());

            $sql2="SELECT * FROM tbl_lists";

            $dofuck2 = mysqli_query($db2, $sql2);

            if($dofuck2==true)
            {
            while($row2=mysqli_fetch_assoc($dofuck2))
            {
            $list_id = $row2['list_id'];
            $list_name = $row2['list_name'];
            ?>

            <a href="<?php echo SITEURL?>listtask.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>

            <?php
            }
            }

            ?>
            <a href="<?php echo SITEURL; ?>managelist.php">Manage Lists</a>
        </div>

        <div class="all-task">
            <a class="btn-primary" href="<?php echo SITEURL;?>addtask.php">Add Task</a>

            <table class="tbl-full">
                <tr>
                    <th>NR.</th>
                    <th>Task Name</th>
                    <th>Priority</th>
                    <th>Deadline</th>
                    <th>Actions</th>
                </tr>

                <?php
                    $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

                    $db_select = mysqli_select_db($db, DB_NAME) or die(mysqli_error());

                    $sql = "SELECT * FROM tbl_tasks WHERE list_id=$list_id_url";


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
                                    <td><?php echo $list_name; ?></td>
                                    <td><?php echo $priority; ?></td>
                                    <td><?php echo $deadline; ?></td>
                                    <td>

                                        <a class="btn-update" href="<?php echo SITEURL; ?>updatetask.php?task_id=<?php echo $task_id; ?>">Update </a>

                                        <a class="btn-delete" href="<?php echo SITEURL; ?>deletetask.php?task_id=<?php echo $task_id; ?>">Delete</a>

                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <tr>
                                <td colespan="5">No Task Added Yet.</td>
                            </tr>
                            <?php
                        }
                    }
                ?>
            </table>
        </div>
    </div>
    </body>


</html>
