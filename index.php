<?php
    include "app/User.php";

    $data = new \Crud\App\User();
    $getInfo = new \Crud\App\Database();

    if(isset($_REQUEST['submit'])){
        $name = $_POST["name"];
        $age = $_POST["age"];
        $email = $_POST["email"];

        $data->registration($name,$age,$email);
    }

    if(isset($_REQUEST['update_info'])){

        $id = $_POST["uid"];
        $name = $_POST["name"];
        $age = $_POST["age"];
        $email = $_POST["email"];

        $data->update($id, $name, $age, $email);
    }

    if(isset($_REQUEST['user_id'])) {
        $id = $_REQUEST['user_id'];

        $data->delete($id);
    }

    $allInfo = $getInfo->getData();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<br><br>

<div class="container">
    <h2 style="text-align: center; text-transform: uppercase; text-decoration: underline darkblue;">Assignment</h2>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <h5 style="text-transform: uppercase; color: dodgerblue;">User Information</h5>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addInfo">Add New User</button></li>
            </ul>
        </div>
    </nav>
    <table class="table table-bordered" style="text-align: center;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($allInfo as $infos) : ?>
            <tr>
                <td><?php echo $infos['id'] ?></td>
                <td><?php echo $infos['name'] ?></td>
                <td><?php echo $infos['age'] ?></td>
                <td><?php echo $infos['email'] ?></td>
                <td>
                    <input type="button" name="edit" id="<?php echo $infos['id']?>" class="btn btn-primary edit_information" data-toggle="modal" data-target="#myEditModal" value="Edit">
                    <button type="button" name="delete" id="<?php echo $infos['id']?>" class="btn btn-danger delete" data-toggle = "modal" data-target = "#Delete_record" value="">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Add Information -->
<div class="modal fade" id="addInfo">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">New User Add Form</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="" method="POST">

                <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter email" name="name">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Age:</label>
                            <input type="number" class="form-control" id="age" placeholder="Enter password" name="age">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter password" name="email">
                        </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Edit Information -->
<div class="modal fade" id="myEditModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Edit User Form</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body"  id="edit_info">
            </div>
        </div>
    </div>
</div>

<!--Delete Information-->
<div class="modal fade" id="Delete_record" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <center><label class = "text-danger">Are you sure you want to delete this record?</label></center>
                <br />
                <center><a class = "btn btn-danger remove_id" ><span class = "glyphicon glyphicon-trash"></span> Yes</a> <button type = "button" class = "btn btn-warning" data-dismiss = "modal" aria-label = "No"><span class = "glyphicon glyphicon-remove"></span> No</button></center>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        $('.edit_information').click(function(){
            var user_id = $(this).attr("id");
            $.ajax({
                url:"app/modalfile.php",
                method:"post",
                data:{id:user_id},
                success:function(data){
                    $('#edit_info').html(data);
                    $('#myEditModal').modal("show");
                }
            });
        });

        $('.delete').click(function(){
            var $user_id = $(this).attr('id');
            $('.remove_id').click(function(){
                window.location = '?user_id=' + $user_id;
            });
        });

    });
</script>

</body>
</html>
