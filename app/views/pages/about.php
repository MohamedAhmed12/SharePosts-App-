<?php require APPROOT . '/views/inc/header.php' ;?>
<div class="jumbotron text-center">
  <div class="container">
    <h1 class="display-2"><?php echo $data['title'];?></h1>
    <p class="lead"><?php echo $data['desc'];?></p>
    <p class="lead"><?php echo 'App Version: ' . APPVERSION; ?></p>
  </div>
</div>
<?php require APPROOT . '/views/inc/footer.php' ;?>