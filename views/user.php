<div class="card shadow border-0 mb-7">
    <div class="card-header bg-primary text-white text-center">
        <h5 class="mb-0">Users</h5>
    </div>
    <div class="table-responsive p-4">
        <?php 
            if (is_null($datas) || empty($datas)) {
                echo "<div class='d-flex justify-content-center align-items-center w-100 py-3'>
                        <span class='text-muted fs-5'>There is no Data</span>
                    </div>";
                return;
            }
        ?>
        <table class="table table-hover table-bordered text-center">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Firstname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datas['data'] as $value) { ?>
                    <tr>
                        <td><?php echo $value->getFirstname(); ?></td>
                        <td><?php echo $value->getEmail(); ?></td>
                        <td><?php echo $value->getRole_name(); ?></td>
                        <?php
                        if (strtolower($value->getRole_name()) != "admin") { ?>
                            <td>
                                <form action="/user/delete" method="POST" style="display:inline;">
                                    <input type="hidden" name="user_id" value="<?php echo $value->getId(); ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>

                                <form action="/user/get" method="POST" style="display:inline;">
                                    <input type="hidden" name="user_id" value="<?php echo $value->getId(); ?>">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </form>
                            </td>
                        <?php }
                        ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>