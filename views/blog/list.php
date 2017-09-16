<?php include ROOT . '/views/layouts/header.php'; ?>
<div class="row" id="article">
    <?php /** @var $newsList */
foreach ($newsList2 as $newsItem):?>
    <div class="col-sm-6 col-md-12">
        <div class="thumbnail blog">
            <h3><?php echo $newsItem['title'];?></h3>
            <img src="/template/img/news/<?php echo $newsItem['id'] ;?>.jpg">
            <p><?php echo $newsItem['short_content'];?></p>
            <div class="content">
                <div class="post">
                    <?php
                        echo ('<p>Likes: '.$newsItem['likes'].'</p>');
                        // $rowCount = $newsItem['if_like'];
                        // echo $rowCount.'++'.'</br>';
                        if ($newsItem['if_like'] == 1) { ?>
                            <!-- user already likes post -->
                            <span><a href="" class="unlike btn btn-primary" role="button" id="<?php echo $newsItem['id']; ?>">Unlike</a></span>
                    <?php } else { ?>
                        <!-- user has not yet liked post -->
                        <span><a href="" class="like btn btn-primary" role="button" id="<?php echo $newsItem['id']; ?>">Like</a></span>
                    <?php } ?>
                </div>
            </div>
            <p align="center"><strong>Дата публікації: <?php echo $newsItem['date']; ?></strong></p>
            <p align="center"><a href="/blog/<?php echo $newsItem['id'];?>" class="btn btn-primary" role="button">Читати</a></p>
        </div>
    </div>
<?php endforeach; ?>
</div>
<?php include ROOT . '/views/layouts/footer.php'; ?>

<script src="/template/js/ajax.js"></script>