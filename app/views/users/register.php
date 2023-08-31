<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row ">
<div class="col-md-6 mx-auto">
<div class="card  card-body bg-light mt-5">
    <h1>Create An Account</h1>
    <P>Please fill out this form to register with us</P>
    <form action="<?php echo URLROOT; ?>/users/register " method="post">
    <div class="form-group">
        <label id="labeltop"for="name">Name:<sup>*</sup></label>
        <input type="text" name="name" class="form-control form-control-lg 
            <?php echo (!empty($data['name_err'])) ? "is-invalid" : '';?>"
            value="<?php echo $data['name'];?>" >
            <spn class="invalid-feedback"><?php echo $data['name_err'];?></spn>
    </div>
    <div class="form-group">
        <label class="labelmiddle" for="email">Email:<sup>*</sup></label>
        <input type="email" name="email" class="form-control form-control-lg 
            <?php echo (!empty($data['email_err'])) ? "is-invalid" : '';?>"
            value="<?php echo $data['email'];?>" >
            <spn class="invalid-feedback"><?php echo $data['email_err'];?></spn>
    </div>
    <div class="form-group">
        <label class="labelmiddle" for="password">Password:<sup>*</sup></label>
        <input type="password" name="password" class="form-control form-control-lg 
            <?php echo (!empty($data['password_err'])) ? "is-invalid" : '';?>"
            value="<?php echo $data['password'];?>" >
            <spn class="invalid-feedback"><?php echo $data['password_err'];?></spn>
    </div>
    <div class="form-group">
        <label class="labelmiddle" for="confirm_password">Confirm Password:<sup>*</sup></label>
        <input id="lastInput" type="password" name="confirm_password" class="form-control form-control-lg 
            <?php echo (!empty($data['confirm_password_err'])) ? "is-invalid" : '';?>"
            value="<?php echo $data['confirm_password'];?>" >
            <spn class="invalid-feedback"><?php echo $data['confirm_password_err'];?></spn>
    </div>

    <div class="row">
        <div class="col">
            <input type="submit" value="SignUp" id="btn-wide" class="btn btn-success btn-block">
        </div>
        <div class="col">
            <a href="<?php echo URLROOT?>/users/login" class="btn btn-light btn-block">
            Have an account? Login
            </a>
        </div>
    </div>
    </form>
</div>
</div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>