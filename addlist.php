<?php
    include('config.php');
?>

<html>
    <head>
        <title>X Manager - Add List</title>
    </head>

    <body>

        <h1>X Manager</h1>

        <a href="<?php echo SITEURL;?>">Home</a>
        <a href="<?php echo SITEURL; ?>managelist.php">Manage Lists</a>


        <h3>Add List Page</h3>

        <p>
            <?php
                //Check session status
                if(isset($_SESSION['add_fail']))
                {
                    //display session fail message
                    echo $_SESSION['add_fail'];
                    //remote session display
                    unset($_SESSION['add_fail']);
                }
            ?>

        </p>

        <!-- Form To Add List Starts Here -->

        <form method="POST" action="">

                <table>
                    <tr>
                        <td>List Name:</td>
                        <td><input type="text" name="list_name" placeholder="Type List Name Here" required="required"/></td>
                    </tr>
                    <tr>
                        <td>List Description: </td>
                        <td><textarea name="list_description" placeholder="Type List Description Here"></textarea></td>
                    </tr>

                    <tr>
                        <td><input type="submit" name="submit" value="Submit" /></td>
                    </tr>
                </table>

        </form>

        <!-- Form To Add List Ends Here -->

    </body>
</html>


<?php

    //Check whether the form is submitted or not
    if(isset($_POST['submit']))
    {
        //echo "Form Submitted";

        // Get values from form and save in var.

        $list_name = $_POST['list_name'];
        $list_description = $_POST['list_description'];

        // Database connection

        $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        IF (!$db) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $db_select = mysqli_select_db($db, DB_NAME);

        // Sql query data insertion
        $sql = "INSERT INTO tbl_lists SET
            list_name = '$list_name',
            list_description = '$list_description'
        ";

        // Execute query

        $dofuck = mysqli_query($db, $sql);

        // Check query fail or pass
        if($dofuck==true)
        {
            //Data pass
            //echo "Data Pass";

            //Create session var to display message
            $_SESSION['add'] = "List Added successfully";

            // Back to Manage List
            header('location:'.SITEURL.'managelist.php');

        }
        else
        {
            //Data Fail
            //echo "Data Fail";

            //Create session var to display message
            $_SESSION['add'] = "Failed to Add List";

            // Reload because of failure
            header('location'.SITEURL.'addlist.php');
        }
    }
?>