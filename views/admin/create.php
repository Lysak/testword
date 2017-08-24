<?php include ROOT . '/views/layouts/header.php'; ?>
    <h4 align="center">Додати новину</h4>
           
    <form class="form-default" method="post" role="form" enctype="multipart/form-data" >
        <div class="form-group">
            <label for="usr">Заголовок:</label>
            <input type="text" name="title" class="form-control" id="usr" required>
        </div>
        <div class="form-group">
            <label for="pwd">Короткий опис:</label>
            <textarea class="form-control" name="short_content" rows="5" id="comment" required></textarea>
        </div>
        <div class="form-group">
            <label for="comment">Детально:</label>
            <textarea class="form-control" name="content" rows="8" id="comment" required></textarea>
        </div>
        <div class="form-group">
            <label for="comment">Додати зображення:</label>
            <input type="file" name="image" class="file">
        </div>

        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">ДОДАТИ НОВИНУ</button>
    </form>

<?php include ROOT . '/views/layouts/footer.php'; ?>