<?php include ROOT . '/views/layouts/header.php'; ?>
<?php 
	// connect to the DB
//    $db = DB::getConnection();
//
//    if (isset($_POST['liked'])) {
//        $postid = $_POST['postid'];
//        $result = $db->query("SELECT * FROM articles WHERE id=$postid");
//        $row = $result->fetch(PDO::FETCH_ASSOC);
//        $n = $row['likes'];
//
//        $db->query("UPDATE articles SET likes=$n+1 WHERE id=$postid");
//        $db->query("INSERT INTO likes(userid, postid) VALUE(1, $postid)");
//        exit();
//    }
//    if (isset($_POST['unliked'])) {
//        $postid = $_POST['postid'];
//        $result = $db->query("SELECT * FROM articles WHERE id=$postid");
//        $row = $result->fetch(PDO::FETCH_ASSOC);
//        $n = $row['likes'];
//        //delete from the likes before updation posts
//        $db->query("DELETE FROM likes WHERE postid=$postid AND userid=1");
//        $db->query("UPDATE articles SET likes=$n-1 WHERE id=$postid");
//        exit();
//    }
 ?>

<div class="row">
    <?php /** @var $newsList */
foreach ($newsList as $newsItem):?>
    <div class="col-sm-6 col-md-12">
        <div class="thumbnail blog">
            <h3><?php echo $newsItem['title'];?></h3>
            <img src="/template/img/news/<?php echo $newsItem['id'] ;?>.jpg">
            <p><?php echo $newsItem['short_content'];?></p>
            <div class="content">
                <div class="post">
                    <?php
                    Blog::ifUserHasAlreadyLikeThisPost($newsItem);
                    $rowCount = Blog::ifUserHasAlreadyLikeThisPost($newsItem);
                    // determine if user has already like this post
//                    $result = $db->query("SELECT * FROM likes WHERE userid=1 AND postid=".$newsItem['id']."");
//                    $result->execute();
                    // if (mysql_num_rows($result) == 1) { ?/>
                    print_r($newsItem['likes'].'<br>');
                    if ($rowCount == 1) { ?>
                        <!-- user already likes post -->
                        <span><a href="" class="unlike btn btn-primary" role="button" id="<?php echo $newsItem['id']; ?>">Unlike</a></span>
                    <?php } else { ?>
                        <!-- user has not yet liked post -->
                        <span><a href="" class="like btn btn-primary" role="button" id="<?php echo $newsItem['id']; ?>">Like</a></span>
                    <?php } ?>
                </div>
            </div>
            <p align="center"><strong>Дата публікації: <?php echo $newsItem['date'];?></strong></p>
            <p align="center"><a href="/blog/<?php echo $newsItem['id'];?>" class="btn btn-primary" role="button">Читати</a></p>
        </div>
    </div>
<?php endforeach; ?>

<?php //foreach ($newsList as $value) :?>
<!--  <div class="col-sm-6 col-md-12">-->
<!--    <div class="thumbnail">-->
<!--        <h3>--><?php //echo $value['title'];?><!--</h3>-->
<!--        <img src="/template/img/news/--><?php //echo $value['id'];?><!--.jpg">-->
<!--        <p>--><?php //echo $value['short_content'];?><!--</p>-->
<!--		<p align="center"><strong>Дата публікації: --><?php //echo $value['date'];?><!--</strong></p>-->
<!--        <p align="center"><a href="/blog/--><?php //echo $value['id'];?><!--" class="btn btn-primary" role="button">Читати</a></p>-->
<!--  </div>-->
<!--</div>-->
<?php //endforeach; ?>
<?php include ROOT . '/views/layouts/footer.php'; ?>
<script language="javascript" type="text/javascript">
	$(document).ready(function() {
		// when the user clicks on like
		$('.like').click(function() {
			var postid = $(this).attr('id');
			// alert('You clicked on ' + postid);
			$.ajax({
				url: 'blog',
				type: 'post',
				async: false,
				data: {
					'liked': 1,
					'postid': postid
				},
				success: function() {
				}
			});
		});

		// when the user clicks on unlike
		$('.unlike').click(function() {
			var postid = $(this).attr('id');
			// alert('You clicked on ' + postid);
			$.ajax({
				url: 'blog',
				type: 'post',
				async: false,
				data: {
					'unliked': 1,
					'postid': postid
				},
				success: function() {
				}
			});
		});
	});
</script>
</div>