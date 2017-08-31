<?php include(ROOT."/views/layouts/header.php"); ?>
<div id="welcome">	
	<h2>Welcome, <span><?php echo $_SESSION['session_username'];?>! </span></h2>
	<p><a href="logout">Logout</a> Here!</p>
</div>

<?php include(ROOT."/views/layouts/footer.php"); ?>
