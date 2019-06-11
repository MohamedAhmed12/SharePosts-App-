<?php require APPROOT . '/views/inc/header.php' ;?>
<!--Back Button-->
<a href="<?php echo URLROOT; ?>posts" class="btn btn-secondary pr-3 pl-3 mb-4">
    <i class="fas fa-angle-left"></i> Back
</a>
<!--Start Post-->
<h1><?php echo $data['post']->title; ?></h1>
<div class="text-dark pt-2 mb-3 w-50">
    Written by <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at; ?> 
</div>
<!--Post Body-->
<p class="lead card card-body bg-light p-3"><?php echo $data['post']->body; ?></p>

<!--Check to see if the loggedin user if the post author-->
<?php
      if($data['post']->user_id === $_SESSION['user_id']){ ?>
        
        <!--  Show Edit Button-->
        <a href="<?php echo URLROOT; ?>posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">Edit</a>

        <!--  Show Delete Button-->
        <!--Deleting Post Using Form-->
        <form action="<?php echo URLROOT;?>posts/delete/<?php echo $data['post']->id;?>" class="float-right" method="post">
            <input class="btn btn-danger" type="submit" value="Delete">
        </form>
<?php } ?>
<!--End Post-->

<?php require APPROOT . '/views/inc/footer.php' ;?>