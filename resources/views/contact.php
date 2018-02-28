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
            <form method="post" action="<?= url('contact'); ?>">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Your Name">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter Your Email">
                </div>
                <div class="form-group">
                    <label>Your Message</label>
                    <textarea name="message" id="" cols="30" rows="10" class="form-control" placeholder="Message"></textarea>
                </div>
                <button class="btn btn-primary" type="submit" name="send_message">Send Message</button>

            </form>
        </div>
    </div>

</div><!-- /.container -->

<?php include resource_partial('footer'); ?>
