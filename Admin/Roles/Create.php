<?php

require '../helpers/DBConnection.php';
require '../helpers/functions.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title = Clean($_POST['title']);

    $errors = [];

    if (!Validate($title, 'required')) {   
        $errors['Title'] = "Field Required";
    }

    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        
        $sql = "insert into roles (title) values ('$title')";
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

            PrintMessages('Dashboard / Roles / Create');

            ?>




        </ol>



        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Title</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="title" placeholder="Enter Role Title">
            </div>

            <button type="submit" class="btn btn-primary">SAVE</button>
        </form>




    </div>
</main>





<?php

require '../layouts/footer.php';

?>