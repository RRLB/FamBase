<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="card card-body bg-light mt-5">
<h1><?php echo $data['title'];?></h1>
<p class="lead"><?php echo $data['description']; ?></p>
</div>
<p id='version'>Version :<strong><?php echo APPVERSION; ?></strong></p>
<?php require APPROOT . '/views/inc/footer.php'; ?>