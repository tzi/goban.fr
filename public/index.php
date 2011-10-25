<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once( '../controller/goban_controller.class.php' );
$goban_controller = new GobanController();

$admin = FALSE;
if ( isset( $_GET[ 'admin' ] ) && $_GET[ 'admin' ] == 'coco' ) {
    $admin = TRUE;
    $goban_controller->admin = TRUE;
}


// GOBAN VIEW
if ( $goban_controller->is_goban_url( ) ) {

    if ( $goban_controller->load( ) ) {

        // TRY TO EDIT
        if ( $goban_controller->is_edit_url( ) ) {
			
			// NO RIGHT TO EDIT
			if ( ! $goban_controller->can_edit( ) ) {
				require( '../view/403.php' );
				exit;
			}

            // APPLY EDITION
            if ( $goban_controller->is_apply_edition_url( ) ) {
			    $goban_controller->update( );
                header( 'Location: ' . $goban_controller->edit_url() );   
                exit;
            }
		}

        // DISPLAY GOBAN
        require( '../view/goban.php' );
        exit;
   
    // UNKNOWN GOBAN 
    } else {
      require( '../view/404.php' ); 
      exit;
    }

// NEW VIEW
} else if ( $goban_controller->is_create_url( ) ) {
    $goban_controller->create( );
    header( 'Location: ' . $goban_controller->edit_url() );
    exit;
}

// INDEX VIEW
require( '../view/index.php' );

?>
