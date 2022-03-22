<?php

# Logic ...... 
require '../helpers/DBConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';

# Fetch Data .... 
$sql = "select users.* , userroles.title from users  inner join userroles on users.role_id = userroles.id";
$op  = doQuery($sql);




require '../layouts/header.php';

require '../layouts/nav.php';

require '../layouts/sidNav.php';
?>




<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">

            <?php

            PrintMessages('Dashboard/Roles');

            ?>
        </ol>






        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                List User System Roles
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>PHONE</th>
                                <th>TYPE</th>
                                <th>IMAGE</th>
                                <th>CONTROL</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>PHONE</th>
                                <th>TYPE</th>
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
                                    <td><?php echo $data['user_id']; ?></td>
                                    <td><?php echo $data['name']; ?></td>
                                    <td><?php echo $data['email']; ?></td>
                                    <td><?php echo $data['phone']; ?></td>
                                    <td><?php echo $data['title']; ?></td>
                                    <td> <img src="./uploads/<?php echo $data['image']; ?>" width="80px" height="80px"> </td>
                                    <td>
                                        <a href='Remove.php?id=<?php echo $data['user_id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>

                                        <a href='edit.php?id=<?php echo $data['user_id']; ?>' class='btn btn-primary m-r-1em'>Edit</a>
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