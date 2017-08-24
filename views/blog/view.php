<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="row">

<div class="col-sm-6 col-md-12">
    <div class="thumbnail">
        <h3><?php echo mb_strtoupper($newsItem['title']);?></h3>
        <img src="/template/img/news/<?php echo $newsItem['id'];?>.jpg">
        <p><?php echo nl2br($newsItem['content']);?></p>
        <p><a href="/blog/" class="btn btn-primary" role="button">Повернутися</a>
    </div>
</div>

<?php //foreach ($newsItem as $value) :?>
<!--  <div class="col-sm-6 col-md-12">-->
<!--    <div class="thumbnail">-->
<!--        <h3>--><?php //echo mb_strtoupper($value['title']);?><!--</h3>-->
<!--        <img src="/template/img/news/--><?php //echo $value['id'];?><!--.jpg">-->
<!--        <p>--><?php //echo nl2br($value['content']);?><!--</p>-->
<!--        <p><a href="/blog" class="btn btn-primary" role="button">Повернутися</a>-->
<!--  </div>-->
<!--</div>-->
<?php //endforeach; ?>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>