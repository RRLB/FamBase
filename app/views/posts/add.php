<?php require APPROOT . '/views/inc/header.php'; ?>

<a href="<?php echo URLROOT ?>/posts" class="btn btn-light">
<i class="fa fa-backward">
</i> BACK</a>

<div class="card  card-body bg-light mt-5">

    <h1>ADD POST</h1>

    <P>Create a post with this form</P>

    <form action="<?php echo URLROOT; ?>/posts/add " method="post">

        <div class="form-group">

            <label for="title">Title: <sup>*</sup></label>

            <input type="text" name="title" class="form-control form-control-lg 
            <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>"
            >

            <spn class="invalid-feedback">
                <?php echo $data['title_err']; ?>
            </spn>

        </div>

        <div class="form-group">

            <label for="body">Body: 
                <sup>*</sup>
            </label>

            <textarea name="body" class="form-control form-control-lg 
                <?php echo (!empty($data['body_err'])) ? "is-invalid" : ''; ?>">
                <?php echo $data['body']; ?>
            </textarea>

            <spn class="invalid-feedback"><?php echo $data['body_err']; ?>
            </spn>

        </div>

        <input type="submit" class="btn btn-success mt-3" value="Submit">
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>