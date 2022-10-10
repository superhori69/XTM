<?php
    include('config.php');
?>
<html>

    <head>
        <title>X Manager - Home</title>
    </head>

    <body>
        <h1>Task Manager</h1>

        <!-- Menu Start -->
        <div class="Menu">

            <a href="<?php echo SITEURL; ?>"?>Home</a>

            <a href="#">To Do</a>
            <a href="#">Doing</a>
            <a href="#">Done</a>

            <a href="<?php echo SITEURL; ?>managelist.php">Manage Lists</a>
        </div>
        <!-- Menu End -->

        <!-- Task Start -->

        <div class="all-tasks">

            <table>

                <tr>
                    <th>S.N</th>
                    <th>Task Name</th>
                    <th>Priority</th>
                    <th>Deadline</th>
                    <th>Actions</th>
                </tr>

                <tr>
                    <td>1. </td>
                    <td>Design a Website</td>
                    <td>Medium</td>
                    <td>23/05/2022</td>
                    <td>
                        <a href="#">Update</a>

                        <a href="#">Delete</a>

                    </td>
                </tr>
            </table>

        </div>

    </body>

</html>