<!DOCTYPE html>
<html>
<head>
    <title>Online Goban</title>
    <link href="./goban_classic.css" rel="stylesheet" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="./goban.js"></script>
</head>
<body>
  <div class="goban <?= ($edit_goban?'edit':'') ?>">
  <?php
  for( $y = 1; $y <= $goban_size; $y++ ) {
    for( $x = 1; $x <= $goban_size; $x++ ) {
      $cell_classes = 'cell row' . $y . ' col' . $x;
      if ( $x == 1 ) $cell_classes .= ' first_col';
      else if ( $x == $goban_size ) $cell_classes .= ' last_col';
      if ( $y == 1 ) $cell_classes .= ' first_row';
      else if ( $y == $goban_size ) $cell_classes .= ' last_row';
      $content_classes = 'content';
      $content_attribute = '';
      $content_tag = 'span';
      if ( isset( $stones[ $x ][ $y ] ) ) $content_classes .= ' stone '.$stones[ $x ][ $y ];
      if ( $edit_goban ) {
        $content_tag = 'a';
        $content_attribute = ' href="javascript:;"';
        $content_classes .= ' action';
      }
    ?>
      <div class="<?= $cell_classes ?>">
        <<?= $content_tag ?> class="<?= $content_classes ?>" <?= $content_attribute ?>> </<?= $content_tag ?>>
      </div>
    <?php
    }
  }
  ?>
  </div>
</body>
</html>
