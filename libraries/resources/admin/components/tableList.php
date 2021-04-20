<?php 

    include('../app/controllers/AdminController.php');

    $users = $adminController->getAllData();

?>

<div class="container p-5">
<!-- <button class="btn btn-secondary my-3 mr-3">Add User</button> -->
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr class="text-center">
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">User Type</th>
                <th scope="col">Active</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
            <tr>
                <th scope="row"><?php echo $user['id'] ?></th>
                <td><?php echo $user['firstname'] ?></td>
                <td><?php echo $user['lastname'] ?></td>

                <?php if($user['isType'] === '1'): ?>
                    <td><span class="badge bg-success">Administrator</span></td>
                <?php else: ?>
                    <td><span class="badge bg-info">Normal User</span></td>
                <?php endif; ?>
                <!-- administrator -->
                <?php if($user['isActive'] === '1'): ?>
                    <td><span class="badge bg-success">Active</span></td>
                <?php else: ?>
                    <td><span class="badge bg-danger">Inactive</span></td>
                <?php endif; ?>
                <!-- normal user -->
                <?php if($user['isType'] === '0'): ?>
                    <!-- active user-->
                    <?php if($user['isActive'] === '1'): ?>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="modify(<?php echo $user['id'] ?>)">Modify</button>
                        <button class="btn btn-danger btn-sm">Remove</button>
                        <button class="btn btn-danger btn-sm" onclick="update_deactivate(<?php echo $user['id']?>)">Deactivate</button>
                    </td>
                    <!-- inactive user -->
                    <?php else: ?>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="modify(<?php echo $user['id'] ?>)">Modify</button>
                            <button class="btn btn-danger btn-sm">Remove</button>
                            <button class="btn btn-success btn-sm" onclick="update_activate(<?php echo $user['id']?>)">Activate</button>
                        </td>
                    <?php endif; ?>

                <?php else: ?>
                    <td>
                        <button class="btn btn-primary btn-sm">Modify</button>
                    </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>