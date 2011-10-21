<!DOCTYPE html>
<html>
<head>
    <title>Online Goban</title>
    <link href="./goban_classic.css" rel="stylesheet" type="text/css" />
</head>
<body>
  <div class="goban">
  <?php
  for( $y = 1; $y <= $goban_size; $y++ ) {
    for( $x = 1; $x <= $goban_size; $x++ ) {
    ?>
      <div class="cell col<?= $x ?> row<?= $y ?>">
      <?php
        if ( isset( $stones[ $x ][ $y ] ) ) {
        ?>
          <div class="stone <?= $stones[ $x ][ $y ] ?>"> </div>
        <?php
        } else if ( $action ) {
        ?>
          <a class="action" href="?x=<?= $x ?>&y=<?= $y ?>"> </a>
        <?php
        }
      ?>  
      </div>
    <?php
    }
  }
  ?>
  </div>
</body>
</html>