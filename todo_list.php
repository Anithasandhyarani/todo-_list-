<?php
session_start();
if (isset($_SESSION['insert'])) {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todo list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="container mt-4">
            <h3>Todo list</h3>

            <div>
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<div class="alert alert-danger w-25">' . htmlspecialchars($_SESSION['error']) .
                        '<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
                unset($_SESSION['error']);
                ?>
                <?php
                if (isset($_SESSION['suc'])) {
                    echo '<div class="alert alert-success w-25">' . htmlspecialchars($_SESSION['suc']) . '<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
                unset($_SESSION['suc']);
                ?>
                <?php
                if (isset($_SESSION['insert'])) {
                    echo '<div class="alert alert-success w-25">' . htmlspecialchars($_SESSION['insert']) . '<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
                unset($_SESSION['insert']);
                ?>

            </div>

            <div class="row">
                <div class="col-4">

                    <input type="text" class="form-control w-100" name="task">
                </div>
                <div class="col-4">

                    <button type="submit" class="btn btn-primary" name="submit">add task</button>

                </div>
            </div>

    </form>
    <?php
    $con = mysqli_connect("localhost", "root", "", "employee_management_db");
    $task = isset($_POST['task']) ? $_POST['task'] : '';



    if (isset($_POST['submit'])) {
        $task = $_POST['task'] ?? '';
        $error = '';


        if (empty($task)) {
            $_SESSION['error'] = "Task is required!";
            header("location:todo_list.php?error= $_SESSION[error]");
            exit(0);
        } else {

            $sql = "INSERT INTO todo_list (task) values('$task')";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $_SESSION['insert'] = "inserted successfully";
                header("location:todo_list.php?insert= $_SESSION[insert]");
            } else {
                echo "not inserted";
            }
        }
    }
    ?>

    <table class="table">
        <tbody>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>task</th>
                    <th>Action</th>
                </tr>
                <?php
                $con = mysqli_connect("localhost", "root", "", "employee_management_db");
                $task = isset($_POST['task']) ? $_POST['task'] : '';
                $cnt = 1;
                $sql = "SELECT * FROM todo_list ";
                $result = mysqli_query($con, $sql);

                while ($row = mysqli_fetch_assoc($result)) {

                ?>
                    <tr>
                        <td><?php echo $cnt++ ?></td>
                        <td><?php echo $row['task'] ?></td>

                        <td><a href="delete.php?id=<?php echo $row['id'] ?>">Done</a>
                        </td>


                    </tr>
                <?php
                }
                ?>


            </thead>
        </tbody>

    </table>
    </div>

</body>

</html>