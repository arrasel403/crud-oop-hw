<?php
    include_once "User.php";
    $data1 = new \Crud\App\User();

    if(isset($_POST["id"])){
        $userId = $_POST["id"];
        $info1 = $data1->pick_user_information($userId);
    }

?>

<form action="" method="POST">
    <div class="modal-body"  id="edit_info">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="hidden" class="form-control" id="uid" placeholder="Enter email" name="uid" value="<?php echo $info1['id']?>">
            <input type="text" class="form-control" id="name" placeholder="Enter email" name="name" value="<?php echo $info1['name']?>">
        </div>
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" class="form-control" id="age" placeholder="Enter password" name="age" value="<?php echo $info1['age']?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter password" name="email" value="<?php echo $info1['email']?>">
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" name="update_info" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
</form>


