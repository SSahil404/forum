<?php $userid = $_SESSION["userid"]; ?>

<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="catModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="catModalLabel">Add a Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="components/_handleCategory.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="catTitle" class="form-label">Category Title</label>
                        <input type="text" class="form-control" id="catTitle" name="catTitle"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="catDesc">Category Description</label>
                        <textarea name="catDesc" class="form-control" id="catDesc" rows="3"></textarea>
                        <input type="hidden" name="userid" value='<?php echo $userid; ?>'>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button submit" class="btn btn-success">Add Category</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </form>
        </div>
    </div>
</div>