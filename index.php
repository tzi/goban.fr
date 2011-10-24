<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$goban_size = 9;
$data_file = './data.php';

if ( isset( $_POST[ 'edit' ] ) && isset( $_POST[ 'stone' ] ) ) {
    $stones = array();
    $file = fopen( $data_file, 'w' );
    fputs( $file, '<?php' . PHP_EOL . '$stones = array();' . PHP_EOL );
    foreach ( $_POST[ 'stone' ] as $index => $stone ) {
        $index += 1 + $goban_size;
        $x = $index % $goban_size;
        $y = floor( $index / $goban_size );
        if ( ! isset( $stones[ $x ] ) ) {
            $stones[ $x ] = array( );
             fputs( $file, '$stones[ ' . $x . ' ] = array();' . PHP_EOL );
        }
        $stones[ $x ][ $y ] = ( $stone == 'X' ) ? 'black' : 'white';
        fputs( $file, '$stones[ ' . $x . ' ][ ' . $y . ' ] = "' . $stones[ $x ][ $y ] . '";' . PHP_EOL );
    }  
    fputs( $file, '?>' );
    fclose( $file );    
} else if ( file_exists( $data_file ) ) {
    require( $data_file );
} else {
    $stones = array();
}

$edit_goban = FALSE;
if ( isset( $_GET[ 'edit' ] ) && $_GET[ 'edit' ] == 1 ) {
    $edit_goban = TRUE;
}

require('./view.php');

?>



