<?php include ROOT . '/views/layouts/header.php'; ?>

          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="/template/img/news/1.jpg" alt="IMG1">
        </div>

        <div class="item">
          <img src="/template/img/news/2.jpg" alt="IMG2">
        </div>

        <div class="item">
          <img src="/template/img/news/3.jpg" alt="IMG3">
        </div>

      </div>
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="icon-prev" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="icon-next" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
</header>

  <div class="jumbotron">
      <h1>Lorem ipsum dolor.</h1>
      <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa consequatur voluptate delectus eveniet quo. Tempore!</p>
  </div>
    <div>
        <?php /** @var $newsList */
    foreach ($newsList as $newsItem):?>
      <div class="col-lg-6 six">
        <div class="thumbnail">
          <h4><?php echo $newsItem['title'];?></h4>
          <div class="center"><img src="/template/img/news/<?php echo $newsItem['id'];?>.jpg"></div>
          <p><?php echo mb_strimwidth($newsItem['short_content'], 0, 40, "...");?></p>
          <p align="center"><strong>Дата публікації: <?php echo $newsItem['date'];?></strong></p>
          <p align="center"><a href="/blog/<?php echo $newsItem['id'];?>" class="btn btn-primary" role="button">Читати</a></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="paginate"><?php echo SiteController::pagination($page, $limit); ?></div>
<?php include ROOT . '/views/layouts/footer.php'; ?>