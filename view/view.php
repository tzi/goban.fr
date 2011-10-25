<!DOCTYPE html>
<html>
<head>
    <title>Goban.fr <?= isset($title)?' - '.$title:'' ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./stylesheet/goban.css" />
    <link rel="stylesheet" type="text/css" href="./stylesheet/goban_classic.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="./javascript/goban.js"></script>
</head>
<body>
	<div class="container">
		<div class="page-header">
			<h1>
				<a href="/">Goban.fr</a>
				<small>Le site de partage de goban en français</small>
			</h1>
		</div>
		<div class="row">
			<div class="span8">
				<?= $main_content ?>
			</div>
		</div>
	</div>
</body>
</html>
