<div class="card shadow border-0 mb-7">
    <div class="card-header bg-light text-white text-center">
        <h5 class="mb-0">Project Details</h5>
    </div>
    <div class="card-body">
        <form>
            <div class="mb-3">
                <label for="projectName" class="form-label"><strong>Project Name</strong></label>
                <input type="text" id="projectName" class="form-control" value="<?php echo $datas['data']->getNom(); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="projectDescription" class="form-label"><strong>Description</strong></label>
                <textarea id="projectDescription" class="form-control" rows="3" readonly><?php echo $datas['data']->getDescription(); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="projectCategory" class="form-label"><strong>Category</strong></label>
                <input type="text" id="projectCategory" class="form-control" value="<?php echo $datas['data']->getCategory()->getNom(); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="projectStatus" class="form-label"><strong>Status</strong></label>
                <input type="text" id="projectStatus" class="form-control" value="<?php echo $datas['data']->getStatus(); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="projectClient" class="form-label"><strong>Client</strong></label>
                <input type="text" id="projectClient" class="form-control" value="<?php echo $datas['data']->getClient()->getFirstname(); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="projectFreelancer" class="form-label"><strong>Freelancer</strong></label>
                <input type="text" id="projectFreelancer" class="form-control" value="<?php echo $datas['data']->getFreelancer()->getFirstname(); ?>" readonly>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <a href="/projet" class="btn btn-secondary">Back</a>
                <form action="/projet/edit" method="POST" style="display:inline;">
                    <input type="hidden" name="project_id" value="<?php echo $datas['data']->getId(); ?>">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </form>
    </div>
</div>
<div class="card shadow border-0 mb-7">
    <div class="card-header bg-light text-white text-center">
        <h5 class="mb-0">Appliers</h5>
    </div>
    <table class="table table-hover table-bordered text-center">
        <thead class="thead-light">
            <tr>
                <th scope="col">Firstname</th>
                <th scope="col">Email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datas['appliers'] as $value) { ?>
                <tr>
                    <td><?php echo $value->getFirstname(); ?></td>
                    <td><?php echo $value->getEmail(); ?></td>
                    <td>
                        <form action="/user/deny" method="POST" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?php echo $value->getId(); ?>">
                            <button type="submit" class="btn btn-success">Accept</button>
                        </form>

                        <form action="/user/accept" method="POST" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?php echo $value->getId(); ?>">
                            <button type="submit" class="btn btn-danger">Deny</button>
                        </form>

                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>