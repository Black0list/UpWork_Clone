<div class="card shadow border-0 mb-7">
    <div class="card-header bg-light text-white text-center">
        <h5 class="mb-0">Projects</h5>
    </div>
    <div>
        <!-- <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">Create</button> -->
        <button type="button" class="btn-sm mb-4 mt-4 ms-4 btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Create</button>
        <!-- ============================ MODAL ============================ -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Offre</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/projet/create" method="POST">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input id="nom" name="nom" class="form-control" placeholder="Enter the name of the Offer">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" class="form-control" placeholder="Enter the Description of the Offer"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select id="category" name="category" class="form-select" required>
                                    <?php
                                    foreach ($datas['category'] as $value) { ?>
                                        <option value="<?php echo $value->getId() ?>"><?php echo $value->getNom() ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" id="client_id" name="client_id" value="<?php echo $_SESSION['user']->getId() ?>" class="form-control" placeholder="Enter the name of the Offer">
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4 px-4 py-4">
        <?php foreach ($datas['data'] as $project) { ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm border-1 hover-lift">
                    <div class="card-body text-center">
                        <div class="col-auto d-flex justify-content-between align-items-center">
                        <form action="/message" method="POST" style="display:inline;">
                                <input type="hidden" name="client_id" value="<?php echo $project->getClient()->getId() ?>">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-chat-dots-fill"></i></button>
                            </form>
                            <form action="/projet/show" method="POST" style="display:inline;">
                                <input type="hidden" name="projet_id" value="<?php echo $project->getId() ?>">
                                <button type="submit" class="btn btn-sm btn-secondary"><i class="bi bi-eye-fill"></i></button>
                            </form>
                        </div>
                        <h5 class="card-title"><?php echo $project->getNom(); ?></h5>
                        <p class="card-text text-muted" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 200px;">
                            <?php echo $project->getDescription(); ?>
                        </p>
                        <p class="text-muted mb-1"><strong>Category:</strong> <?php echo $project->getCategory()->getNom(); ?></p>
                        <p class="text-muted mb-1"><strong>Status:</strong> <?php echo $project->getStatus(); ?></p>
                        <p class="text-muted mb-1"><strong>Client:</strong> <?php echo $project->getClient()->getFirstname(); ?></p>
                        <p class="text-muted"><strong>Freelancer:</strong> <?php echo $project->getFreelancer()->getFirstname(); ?></p>
                    </div>
                    <div class="card-footer bg-light text-center">
                        <form action="/projet/delete" method="POST" style="display:inline;">
                            <input type="hidden" name="projet_id" value="<?php echo $project->getId(); ?>">
                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Delete</button>
                        </form>

                        <form action="/projet/apply" method="POST" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']->getId() ?>">
                            <input type="hidden" name="projet_id" value="<?php echo $project->getId(); ?>">
                            <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check-circle"></i> Apply</button>
                        </form>

                        <form action="/projet/approve" method="POST" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']->getId() ?>">
                            <button type="submit" class="btn btn-sm btn-success mt-2"><i class="bi bi-check-circle"></i> Approve</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</div>