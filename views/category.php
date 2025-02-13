<div class="card shadow border-0 mb-7">
  <div class="card-header bg-light text-white text-center">
    <h5 class="mb-0">Categories</h5>
  </div>
  <div class="table-responsive p-4">
    <?php
    if (is_null($datas['data']) || empty($datas['data'])) {
      echo "<div class='d-flex justify-content-center align-items-center w-100 py-3'>
                        <span class='text-muted fs-5'>There is no Data</span>
                    </div>";
      return;
    }
    ?>
    <table class="table table-hover table-bordered text-center">
      <thead class="thead-light">
        <tr>
          <th scope="col">category</th>
          <th scope="col">description</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($datas['data'] as $value) { ?>
          <tr>
            <td><?php echo $value->getNom(); ?></td>
            <td><?php echo $value->getDescription(); ?></td>
            <td>
              <form action="/category/delete" method="POST" style="display:inline;">
                <input type="hidden" name="category_id" value="<?php echo $value->getId(); ?>">
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>

              <form action="/category/get" method="POST" style="display:inline;">
                <input type="hidden" name="category_id" value="<?php echo $value->getId(); ?>">
                <button type="submit" class="btn btn-primary">Edit</button>
              </form>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>