<?php

# Logic ...... 

require '../helpers/DBConnection.php';
require '../helpers/functions.php';

# Fetch Raw Data ..... 

$id = $_GET['id'];
$sql = "select * from roles where role_id = $id";
$op  = doQuery($sql);
$data = mysqli_fetch_assoc($op);



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 
    $title = Clean($_POST['title']);


    # VALIDATE INPUT ...... 
    $errors = [];

    if (!Validate($title, 'required')) {       //  Validate($title,'required') == false 
        $errors['Title'] = "Field Required";
    }


    # Checke errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        // code ..... 

        $sql = "update roles set title = '$title' where role_id = $id";
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

            PrintMessages('Dashboard / Roles / Edit');

            ?>


        </ol>



        <form action="edit.php?id=<?php echo $data['role_id']; ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Title</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="title" value="<?php echo $data['title']; ?>" placeholder="Enter Role Title">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>




    </div>
</main>





<?php

require '../layouts/footer.php';

?>