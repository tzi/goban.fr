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
      $cell_classes = 'cell';
      if ( $x == 1 ) $cell_classes .= ' first_col';
      else if ( $x == $goban_size ) $cell_classes .= ' last_col';
      if ( $y == 1 ) $cell_classes .= ' first_row';
      else if ( $y == $goban_size ) $cell_classes .= ' last_row';
      $action_classes = 'action';
      if ( isset( $stones[ $x ][ $y ] ) ) $action_classes .= ' stone '.$stones[ $x ][ $y ];
    ?>
      <div class="<?= $cell_classes ?>">
        <a class="<?= $action_classes ?>"> </a>
      </div>
    <?php
    }
  }
  ?>
  </div>
</body>
</html>
