<?php

    include('config.php');

    //Get val of selected list

    if(isset($_GET['list_id']))
    {
        $list_id = $_GET['list_id'];

        $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        IF (!$db) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $db_select = mysqli_select_db($db, DB_NAME) or die(mysqli_error());

        $sql = "SELECT * FROM tbl_lists WHERE list_id=$list_id";

        $dofuck = mysqli_query($db, $sql);

        if($dofuck==true)
        {
            //Get data val from db
            $val = mysqli_fetch_assoc($dofuck);

            //printing $val array
            //print_r($val);

            //Create Individual Var to save data
            $list_name = $val['list_name'];
            $list_description = $val['list_description'];
        }
        else
        {
            header('location'.SITEURL.'managelist.php');
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
            <a href="<?php echo SITEURL; ?>managelist.php">Manage Lists</a>

        </div>

        <h3>Update List</h3>

        <form method="POST" action="">

            <table>
                <tr>
                    <td>List Name: </td>
                    <td><input type="text" name="list_name" value="<?php echo $list_name; ?>" required="required"/></td>
                </tr>

                <tr>
                    <td>List Description: </td>
                    <td>
                        <textarea name="list_description">
                            <?php echo $list_description; ?>
                        </textarea>
                    </td>
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

            $list_name = $_POST['list_name'];
            $list_description = $_POST['list_description'];

            // Database connection

            $db2 = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
            if (!$db) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $db_select2 = mysqli_select_db($db2, DB_NAME);

            // Sql query data insertion
            echo $sql2 = "UPDATE tbl_lists SET
                    list_name = '$list_name',
                    list_description = '$list_description'
                    WHERE list_id='$list_id'
                ";

            // Execute query

            $dofuck2 = mysqli_query($db2, $sql2);

            // Check query fail or pass
            if ($dofuck == true) {
                //Data pass
                //echo "Data Pass";

                //Create session var to display message
                $_SESSION['update'] = "List Updated successfully";

                // Back to Manage List
                header('location:' . SITEURL . 'managelist.php');

            } else {
                //Data Fail
                //echo "Data Fail";

                //Create session var to display message
                $_SESSION['update_fail'] = "Failed to Update List";

                // Reload because of failure
                header('location' . SITEURL . 'update.php');
            }

        }

?>