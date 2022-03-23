<?php

# Logic ...... 
##########################################################################################################
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';

# Fetch Data .... 
if($_SESSION['user']['role'] == "admin"){
                            
    $sql = "select articales.* , categories.title as cat_title , users.name  from articales inner join categories on articales.cat_id = categories.id   inner join users on articales.addedBy = users.id  ";

    }else{

        $writer_id =  $_SESSION['user']['id'];

        $sql = "select articales.* , categories.title as cat_title , users.name  from articales inner join categories on articales.cat_id = categories.id   inner join users on articales.addedBy = users.id  where articales.addedBy = $writer_id ";

    }

$op  = doQuery($sql);

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

            PrintMessages('Dashboard/Articales');

            ?>
        </ol>






        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                List Articales
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>TITLE</th>
                                <th>CONTENT</th>
                                <th>DATE</th>
                                <th>CATEGORY</th>
                                <th>ADDEDBY</th>
                                <th>IMAGE</th>
                                <th>CONTROL</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>TITLE</th>
                                <th>CONTENT</th>
                                <th>DATE</th>
                                <th>CATEGORY</th>
                                <th>ADDEDBY</th>
                                <th>IMAGE</th>
                                <th>CONTROL</th>
                            </tr>
                        </tfoot>


                        <tbody>

                            <?php

                            # Fetch And Print data .... 

                            while ($data = mysqli_fetch_assoc($op)) {

                            ?>
                                <tr>
                                    <td><?php echo $data['id']; ?></td>
                                    <td><?php echo $data['title']; ?></td>
                                    <td><?php echo $data['content']; ?></td>
                                    <td><?php echo date('Y/m/d' , $data['date']); ?></td>
                                    <td><?php echo $data['cat_title']; ?></td>
                                    <td><?php echo $data['name']; ?></td>

                                    <td> <img src="./uploads/<?php echo $data['image']; ?>"  width="80px"  height="80px"  >  </td>
                                    <td>
                                        <a href='Remove.php?id=<?php echo $data['id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>

                                        <a href='edit.php?id=<?php echo $data['id']; ?>' class='btn btn-primary m-r-1em'>Edit</a>
                                    </td>


                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>





<?php

require '../layouts/footer.php';

?>