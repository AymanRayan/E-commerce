<?php

# Logic ...... 

require '../helpers/DBConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';


# Fetch  User Roles 

$sql = "select * from roles";
$roles_op  = doQuery($sql);


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 
    $name     = Clean($_POST['name']);
    $email    = Clean($_POST['email']);
    $password = Clean($_POST['password']);
    $phone    = Clean($_POST['phone']);
    $role_id  = Clean($_POST['role_id']);


    # VALIDATE INPUT ...... 
    $errors = [];

    # Valoidate name .... 
    if (!Validate($name, 'required')) {
        $errors['Name'] = "Field Required";
    } elseif (!Validate($name, 'string')) {
        $errors['Name'] = "InValid String";
    }

    # Validate  email 
    if (!Validate($email, 'required')) {
        $errors['Email'] = "Field Required";
    } elseif (!validate($email, "email")) {
        $errors['Email'] = "Invalid Format";
    }


    # Validate  Password 
    if (!Validate($password, 'required')) {
        $errors['Password'] = "Field Required";
    } elseif (!validate($password, "length")) {
        $errors['Password'] = "Length must Be >= 6 Chars";
    }



    # Validate  phone 
    if (!Validate($phone, 'required')) {
        $errors['Phone'] = "Field Required";
    } elseif (!validate($phone, "phone")) {
        $errors['Phone'] = "Invalid Format";
    }



    # Validate  Role 
    if (!Validate($role_id, 'required')) {
        $errors['Role'] = "Field Required";
    } elseif (!validate($role_id, "number")) {
        $errors['Role'] = "Invalid Number Format";
    }



    # Validate  Image 
    if (!Validate($_FILES['image']['name'], 'required')) {
        $errors['Image'] = "Field Required";
    } elseif (!validate($_FILES, "image")) {
        $errors['Image'] = "Invalid Image Format";
    }





    # Checke errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        // code ..... 

        # Upload Image ..... 

        $image = Upload($_FILES);


        $password = md5($password);

        $sql = "insert into users (name,email,password,phone,user_img,role_id) values ('$name','$email','$password','$phone','$image',$role_id)";
        $op  = doQuery($sql);


        if ($op) {
            $message = ["Message" => "Raw Inserted"];
        } else {
            $message = ["Message" => "Error Try Again"];
        }

        $_SESSION['Message'] = $message;
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

            PrintMessages('Dashboard / Users / Create');

            ?>




        </ol>



        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="name" placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword"> Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
            </div>



            <div class="form-group">
                <label for="exampleInputPassword">User Type</label>
                <select class="form-control" id="exampleInputPassword1" name="role_id">

                    <?php

                    while ($data = mysqli_fetch_assoc($roles_op)) {

                    ?>
                        <option value="<?php echo $data['role_id']; ?>"><?php echo $data['title']; ?></option>

                    <?php } ?>

                </select>
            </div>


            <div class="form-group">
                <label for="exampleInputName">Phone</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="phone" placeholder="Enter phone">
            </div>


            <div class="form-group">
                <label for="exampleInputName">Image</label>
                <input type="file" name="image">
            </div>

            <button type="submit" class="btn btn-primary">SAVE</button>
        </form>




    </div>
</main>





<?php

require '../layouts/footer.php';

?>