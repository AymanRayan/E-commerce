<?php

require '../helpers/DBConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';


$id = $_GET['id'];
$sql = "select * from users where user_id = $id";
$op  = doQuery($sql);
$data = mysqli_fetch_assoc($op);

$sql = "select * from roles";
$roles_op  = doQuery($sql);




if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name     = Clean($_POST['name']);
    $email    = Clean($_POST['email']);
    $phone    = Clean($_POST['phone']);
    $role_id  = Clean($_POST['role_id']);

    $errors = [];

    if (!Validate($name, 'required')) {
        $errors['Name'] = "Field Required";
    }

    if (!Validate($email, 'required')) {
        $errors['Email'] = "Field Required";
    } elseif (!validate($email, "email")) {
        $errors['Email'] = "Invalid Format";
    }


    if (!Validate($phone, 'required')) {
        $errors['Phone'] = "Field Required";
    } elseif (!validate($phone, "length", 11)) {
        $errors['Phone'] = "Length must Be >= 11 Chars";
    }

    if (!Validate($role_id, 'required')) {
        $errors['Role'] = "Field Required";
    } elseif (!validate($role_id, "number")) {
        $errors['Role'] = "Invalid Number Format";
    }

    if (Validate($_FILES['image']['name'], 'required')) {
        if (!validate($_FILES, "image")) {
            $errors['Image'] = "Invalid Image Format";
        }
    }

    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        if (Validate($_FILES['image']['name'], 'required')) {
            $image = Upload($_FILES);
            unlink('uploads/' . $data['user_image']);
        } else {
            $image = $data['user_image'];
        }

        $sql = "update users set name = '$name' , email = '$email' , role_id = $role_id , phone = '$phone' , user_image = '$image' where user_id = $id";
        $op  =  doQuery($sql);

        if ($op) {
            $message = ["Message" => "Raw Updated"];
            $_SESSION['Message'] = $message;
            header("Location: index.php");
            exit();
        } else {
            $message = ["Message" => "Error Try Again"];
            $_SESSION['Message'] = $message;
        }
    }
}






require '../layouts/header.php';

require '../layouts/nav.php';

require '../layouts/sidNav.php';
?>




<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">


            <?php
            PrintMessages('Dashboard / Users / Edit');
            ?>
        </ol>



        <form action="edit.php?id=<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="name" placeholder="Enter Name" value="<?php echo $data['name'] ?>">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="email" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email" value="<?php echo $data['email'] ?>">
            </div>


            <div class="form-group">
                <label for="exampleInputPassword">User Type</label>
                <select class="form-control" id="exampleInputPassword1" name="role_id">

                    <?php
                    while ($role_data = mysqli_fetch_assoc($roles_op)) {
                    ?>
                    <option value="<?php echo $role_data['id']; ?>" <?php if ($role_data['id'] == $data['role_id']) { echo 'selected'; } ?>><?php echo $role_data['title']; ?></option>

                    <?php } ?>

                </select>
            </div>


            <div class="form-group">
                <label for="exampleInputName">Phone</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="phone" value="<?php echo $data['phone'] ?>" placeholder="Enter phone">
            </div>

            <div class="form-group">
                <label for="exampleInputName">Image</label>
                <input type="file" name="image">
            </div>

            <img src="uploads/<?php echo $data['image']; ?>" alt="" height="90" width="90">
            <br>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>




    </div>
</main>





<?php

require '../layouts/footer.php';

?>