<?php

# Logic ...... 
require '../helpers/DBConnection.php';
require '../helpers/functions.php';

# Fetch  User Roles 
$sql = "select * from categories";
$cat_op  = doQuery($sql);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // CODE ..... 
    $name     = Clean($_POST['name']);
    $description   = Clean($_POST['description']);
    $price      = Clean($_POST['price']);
    $cat_id    = Clean($_POST['cat_id']);


    # VALIDATE INPUT ...... 
    $errors = [];

    # Valoidate title .... 
    if (!Validate($name, 'required')) {
        $errors['Name'] = "Field Required";
    }

    # Validate  description 
    if (!Validate($description, 'required')) {
        $errors['Description'] = "Field Required";
    } 

    # Validate price
    if (!Validate($price, 'required')) {
        $errors['Price'] = "Field Required";
    } elseif (!validate($price, "number")) {
        $errors['Price'] = "Invalid Number Format";
    }

    # Validate  Role 
    if (!Validate($cat_id, 'required')) {
        $errors['Category'] = "Field Required";
    } elseif (!validate($cat_id, "number")) {
        $errors['Category'] = "Invalid Number Format";
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
       // $image = Upload($_FILES);
        $user_id = $_SESSION['user']['id'];

        $sql = "insert into products (name,description,price,addBy,category_id) values ('$name','$description' , '$price',$user_id ,$cat_id)"; 
        $op  = doQuery($sql);
        if ($op) {
            $data=mysqli_fetch_assoc($op);
            

            $message = ["Message" => "Raw Inserted"];
        } else {
            $message = ["Message" => "Error Try Again"];
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

            PrintMessages('Dashboard / Articales / Create');

            ?>

        </ol>



        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="name" placeholder="Enter Title">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword"> Details</label>
                <textarea class="form-control" id="exampleInputPassword1" name="description"></textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Category</label>
                <select class="form-control" id="exampleInputPassword1" name="cat_id">

                    <?php

                    while ($data = mysqli_fetch_assoc($cat_op)) {

                    ?>
                        <option value="<?php echo $data['category_id']; ?>"><?php echo $data['title']; ?></option>

                    <?php } ?>

                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputName">Price</label>
                <input type="number" class="form-control" id="exampleInputName" aria-describedby="" name="price" placeholder="Enter Title">
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