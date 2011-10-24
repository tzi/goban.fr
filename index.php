<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once( 'goban.class' );

// GOBAN VIEW
if ( isset( $_GET[ 'id' ] ) ) {

    if ( Goban::exists( $_GET[ 'id' ] ) ) {
        $goban = Goban::load( $_GET[ 'id' ] );
        $edit_goban = FALSE;

        // RIGHT TO EDIT
        if ( isset( $_GET[ 'key' ] ) && $_GET[ 'key' ] == $goban->key ) {

            // EDIT GOBAN
            if ( isset( $_POST[ 'edit' ] ) && isset( $_POST[ 'stone' ] ) ) {
              
                // CALCUL STONES COORDONATES
                $stones = array();
                foreach ( $_POST[ 'stone' ] as $index => $stone ) {
                    $x = $index % $goban->size + 1;
                    $y = floor( $index / $goban->size ) + 1;
                    if ( ! isset( $stones[ $x ] ) ) {
                        $stones[ $x ] = array( );
                    }
                    $stones[ $x ][ $y ] = ( $stone == 'X' ) ? 'black' : 'white';
                }
                $goban->stones = $stones;
                $goban->save();
                header( 'Location: ?id=' . $goban->id );   
                exit;
            }

            if ( isset( $_GET[ 'edit' ] ) && $_GET[ 'edit' ] == 1 ) {
                $edit_goban = TRUE;
            }

        // NO RIGHT TO EDIT
        } else if ( isset( $_GET[ 'key' ] ) ) {
            require( 'view/403.php' );
            exit;
        }

        // DISPLAY GOBAN
        require( 'view/goban.php' );
        exit;
   
    // UNKNOWN GOBAN 
    } else {
      require( 'view/404.php' ); 
      exit;
    }

// NEW VIEW
} else if ( isset( $_GET[ 'new' ] ) ) {
    $goban = new Goban();
    $goban->size = $_GET[ 'new' ];
    $goban->save();
    header( 'Location: ?id=' . $goban->id . '&key=' . $goban->key . '&edit=1' );
    exit;
}

// INDEX VIEW
require( 'view/index.php' );

?>
