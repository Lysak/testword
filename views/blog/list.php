<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="row">
<?php foreach ($newsList as $value) :?>
  <div class="col-sm-6 col-md-12">
    <div class="thumbnail">
        <h3><?php echo $value['title'];?></h3>
        <img src="/template/img/news/<?php echo $value['id'];?>.jpg">
        <p><?php echo $value['preview'];?></p>
		<p align="center"><strong>Дата публікації: <?php echo $value['date'];?></strong></p>
        <p align="center"><a href="/blog/<?php echo $value['id'];?>" class="btn btn-primary" role="button">Читати</a></p>
  </div>
</div>
<?php endforeach; ?>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>