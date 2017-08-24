<?php include ROOT . '/views/layouts/header.php'; ?>
<?php if (isset($errors) && is_array($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <p> - <?php echo $error; ?></p>
        <?php endforeach; ?>
<?php endif; ?>
<form class="form-signin" method="post" role="form">
        <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Увійти</button>
</form>


<?php include ROOT . '/views/layouts/footer.php'; ?>