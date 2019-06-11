<?php require APPROOT . '/views/inc/header.php' ;?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-secondary pr-3 pl-3 ml-5">
    <i class="fas fa-angle-left"></i> Back
</a>
<div class="col-md-10 mx-auto">
    <div class="card card-body bg-light mt-5 mb-5">
        <h2>Edit Post</h2>
        <p>Creat a Post</p>
        <form action="<?php echo URLROOT; ?>posts/edit/<?php echo $data['id']; ?>" method="post">
            <div class="form-group">
                <label for="title">Title: <span class="lead text-danger">*</span></label>
                <input type="text" name="title" class="form-control form-control-lg 
                <?php echo (!empty($data['title_err']))? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
            </div>

            <div class="form-group">
                <label for="body">Body: <span class="lead text-danger">*</span></label>
                <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>" >
                    <?php echo $data['body']; ?>
                </textarea>
                <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
            </div>    
            <input type="submit" class="btn btn-primary" value="Submit">      
        </form>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php' ;?>