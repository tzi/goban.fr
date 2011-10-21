<?php

require('./data.php');

$action = true;
$stones = array( );
foreach( $turns as $turn ) {
    $x = $turn[ 'x' ];
    if ( ! is_array( $stones[ $x ] ) ) {
        $stones [ $x ] = array( );
    }
    $stones[ $x ][ $turn[ 'y' ] ] = $turn[ 'color' ];
}

require('./view.php');

?>



