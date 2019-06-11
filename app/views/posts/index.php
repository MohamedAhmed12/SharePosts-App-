<?php require APPROOT . '/views/inc/header.php' ;?>
<div class="row mb-3">
    <div class="col-md-6">
       <?php flash('post_msg'); ?>
        <h1>Posts</h1>
    </div>
    <div class="col-md-6 clearfix">
        <a href="<?php echo URLROOT ?>/posts/add" class="btn btn-primary float-right mt-1">
            <i class="fas fa-plus"></i> Add Post
        </a>
    </div>
</div>
<?php
    foreach($data['posts'] as $post){ ?>
        <div class="card card-body mb-3">
            <h4 class="card-title"><?php echo $post->title; ?></h4>
            <div class="text-secondary pt-2 mb-3">
                Written by <?php echo $post->name; ?> on <?php echo $post->postCreated; ?>
            </div>
            <p class="card-text lead"><?php echo $post->body; ?></p>
            <a href="<?php echo URLROOT; ?>posts/show/<?php echo $post->postId; ?>" class="text-right text-decoration-none"> More</a> 
         </div>
<?php } ?>
<?php require APPROOT . '/views/inc/footer.php' ;?>