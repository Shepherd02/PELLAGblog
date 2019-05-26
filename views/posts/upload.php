<div class="form-container" style="text-align: center; padding: 0; width: 70%; margin: 0 auto">

    <div class="dashboardcard">
        <h5 style="text-align: center">UPLOAD IMAGE</h5>

        <form role="form" enctype='multipart/form-data' action="" method="post">
            <fieldset>
                <div class="form-group">
                    <label for="name"></label>
                    <input type="text" name="image_title" placeholder="Image Title" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label for="name"></label>
                    <input type="text" name="image_description" placeholder="Image Description (max 255 chars)" required
                           class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="name"></label>
                    <input type="file" name="uploaded_file" placeholder="Choose file" class="form-control"/>
                    <small class="form-text text-muted">Only .jpeg, .jpg and .png files are accepted</small>
                </div>
                <button type="submit" name="upload" class="btn btn-custom"><i class="fas fa-upload"></i> UPLOAD</button>

            </fieldset>
        </form>
    </div>
</div>