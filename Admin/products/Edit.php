<?php

# Logic ...... 
##########################################################################################################
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
##########################################################################################################
# Fetch Raw Data ..... 
$id = $_GET['id'];
$sql = "select * from articales where id = $id";
$op  = doQuery($sql);
$data = mysqli_fetch_assoc($op);

##########################################################################################################
# Check User .... 

if($data['addedBy'] !=  $_SESSION['user']['id']){
    header("Location: ".Url('Articales'));
    exit();
}


##########################################################################################################



// if ($_SERVER['REQUEST_METHOD'] == "POST") {

//    // CODE ..... 
//    $name     = Clean($_POST['name']);
//    $email    = Clean($_POST['email']);
//    $phone    = Clean($_POST['phone']);
//    $role_id  = Clean($_POST['role_id']);


//    # VALIDATE INPUT ...... 
//    $errors = [];

//    # Valoidate name .... 
//    if (!Validate($name, 'required')) {      
//        $errors['Name'] = "Field Required";
//    }

//    # Validate  email 
//    if (!Validate($email, 'required')) {      
//        $errors['Email'] = "Field Required";
//    }elseif(!validate($email,"email")){
//        $errors['Email'] = "Invalid Format";
//    }



//    # Validate  phone 
//      if (!Validate($phone, 'required')) {      
//        $errors['Phone'] = "Field Required";
//       }elseif(!validate($phone,"length",11)){
//        $errors['Phone'] = "Length must Be >= 11 Chars";
//    }



//     # Validate  Role 
//     if (!Validate($role_id, 'required')) {      
//        $errors['Role'] = "Field Required";
//       }elseif(!validate($role_id,"number")){
//        $errors['Role'] = "Invalid Number Format";
//    }

    

//      # Validate  Image 
//      if (Validate($_FILES['image']['name'], 'required')) {      
//         if(!validate($_FILES,"image")){
//        $errors['Image'] = "Invalid Image Format";
//       }
//    }




//     # Checke errors 
//     if (count($errors) > 0) {
//         $_SESSION['Message'] = $errors;
//     } else {
//         // code ..... 


//    # Validate  Image 
//    if (Validate($_FILES['image']['name'], 'required')) {      
 
//         # Upload Image ..... 
//         $image = Upload($_FILES);  
        
//         unlink('uploads/'.$data['image'] ); 
    
//     }else{
//         $image = $data['image']; 
//     }



//         $sql = "update users set name = '$name' , email = '$email' , role_id = $role_id , phone = '$phone' , image = '$image' where id = $id";
//         $op  =  doQuery($sql);


//         if ($op) {
//             $message = ["Message" => "Raw Updated"];
//             $_SESSION['Message'] = $message;
//             header("Location: index.php");
//             exit();
//         } else {
//             $message = ["Message" => "Error Try Again"];
//             $_SESSION['Message'] = $message;
//         }
//     }
// }

##########################################################################################################





require '../layouts/header.php';

require '../layouts/nav.php';

require '../layouts/sidNav.php';
?>




<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">


            <?php

            PrintMessages('Dashboard / Articales / Edit');

            ?>


        </ol>



        <form action="edit.php?id=<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">

        <div class="form-group">
                <label for="exampleInputName">Title</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="title"  value="<?php echo $data['title']?>" placeholder="Enter Title">
            </div>




            <div class="form-group">
                <label for="exampleInputPassword"> Content</label>
                <textarea class="form-control" id="exampleInputPassword1" name="content"> <?php echo $data['title']?>  </textarea>
            </div>



            <div class="form-group">
                <label for="exampleInputName">Image</label>
                <input type="file" name="image" >
            </div>
        
            <img src="uploads/<?php echo $data['image'];?>" alt="" height="90" width="90">
           <br>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>




    </div>
</main>





<?php

require '../layouts/footer.php';

?>