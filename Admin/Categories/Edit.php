<?php

# Logic ...... 

require '../helpers/DBConnection.php';
require '../helpers/functions.php';

# Fetch Raw Data ..... 

$id = $_GET['id'];
$sql = "select * from categories where category_id = $id";
$op  = doQuery($sql);
$data = mysqli_fetch_assoc($op);







if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 
    $title = Clean($_POST['title']);


    # VALIDATE INPUT ...... 
    $errors = [];

    if (!Validate($title, 'required')) {
        Validate($title, 'required') == false;
        $errors['Title'] = "Field Required";
    }


    # Checke errors 
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        // code ..... 

        $sql = "update categories set title = '$title' where category_id = $id";
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

            PrintMessages('Dashboard / Categories / Edit');

            ?>


        </ol>



        <form action="edit.php?id=<?php echo $data['category_id']; ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Title</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="title" value="<?php echo $data['title']; ?>" placeholder="Enter Category Title">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>




    </div>
</main>





<?php

require '../layouts/footer.php';

?>