<?php
    include('config.php');
?>

<html>
    <head>
        <title>X Manager - Manage List</title>
    </head>

    <body>

        <h1>Task Manager</h1>

        <a href="<?php echo SITEURL; ?>">Home</a>

        <h3>Manage Lists Page</h3>

        <p>
            <?php
                //Check display status
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];

                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];

                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['delete_fail']))
                {
                    echo $_SESSION['delete_fail'];

                    unset($_SESSION['delete_fail']);
                }
            ?>
        </p>
        <!-- Table to display lists starts here -->
        <div class="all-lists">

            <a href="<?php echo SITEURL; ?>addlist.php">Add List</a>

            <table>
                <tr>
                    <th>S.N.</th>
                    <th>List Name</th>
                    <th>Actions</th>
                </tr>

                <?php

                    $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
                    IF (!$db) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $db_select = mysqli_select_db($db, DB_NAME);

                    $sql = "SELECT * FROM tbl_lists";

                    $dofuck = mysqli_query($db, $sql);

                    if($dofuck==true)
                    {
                        //echo "Data correctly executed";

                        $cr = mysqli_num_rows($dofuck);

                        $sn = 1;

                        if($cr>0)
                        {
                            while($row=mysqli_fetch_assoc($dofuck))
                            {
                                $list_id = $row['list_id'];
                                $list_name = $row['list_name'];
                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $list_name; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>update.php?list_id=<?php echo $list_id; ?>">Update</a>
                                            <a href="<?php echo SITEURL; ?>delete.php?list_id=<?php echo $list_id; ?>">Delete</a>
                                        </td>
                                    </tr>


                                <?php

                            }
                        }
                        else
                        {
                            ?>
                            <tr>
                                <td colspan="3">No List Available Yet.</td>
                            </tr>
                            <?php
                        }

                    }

                ?>

            </table>
        </div>
        <!-- Table to display lists starts here -->
    </body>
</html>