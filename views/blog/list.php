<?php include ROOT . '/views/layouts/header.php'; ?>
<?php 
	// connect to the DB
	mysql_connect('localhost', 'root', '1');
	mysql_select_db('wp_news');

	if (isset($_POST['liked'])) {
		$postid = $_POST['postid'];
		$result = mysql_query("SELECT * FROM articles WHERE id=$postid");
		$row = mysql_fetch_array($result);
		$n = $row['likes'];

		mysql_query("UPDATE articles SET likes=$n+1 WHERE id=$postid");
		mysql_query("INSERT INTO likes(userid, postid) VALUE(1, $postid)");
		exit();
	}
	if (isset($_POST['unliked'])) {
		$postid = $_POST['postid'];
		$result = mysql_query("SELECT * FROM articles WHERE id=$postid");
		$row = mysql_fetch_array($result);
		$n = $row['likes'];
		//delete from the likes before updation posts
		mysql_query("DELETE FROM likes WHERE postid=$postid AND userid=1");
		mysql_query("UPDATE articles SET likes=$n-1 WHERE id=$postid");
		exit();
	}
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
                    // determine if user has already like this post
                    $result = mysql_query("SELECT * FROM likes WHERE userid=1 AND postid=".$newsItem['id']."");
                    if (mysql_num_rows($result) == 1) { ?>
                        <!-- user already likes post -->
                        <span><a href="" class="unlike" id="<?php echo $newsItem['id']; ?>">unlike</a></span>
                    <?php } else { ?>
                        <!-- user has not yet liked post -->
                        <span><a href="" class="like" id="<?php echo $newsItem['id']; ?>">like</a></span>
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
				url: 'index.php',
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
				url: 'index.php',
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