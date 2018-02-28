<?php
include resource_partial('head');
include resource_partial('header');
?>

<div class="container">

    <div class="starter-template">
        <h1><?= ucwords($data['page_title']); ?></h1>
        <div class="panel">
            <?php if(count($data['message']) != 0): ?>
                <div class="alert alert-danger">
                    <?php foreach ($data['message'] as $message): ?>
                        <li><?= $message; ?></li>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form method="post" action="<?= url('login'); ?>">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter Your email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter Your Password">
                </div>
                <button class="btn btn-primary" type="submit" name="log_in">Sign In</button>

            </form>
        </div>
    </div>

</div><!-- /.container -->

<?php include resource_partial('footer'); ?>
