<?php

require_once( '../model/goban.class.php' );

class GobanController {

	public $edition = FALSE;
    public $goban;
	
	
	/******************************************************************************
	   INITIALIZATION
	*******************************************************************************/
    public function load( ) {
		if ( $this->exists( $_GET[ 'id' ] ) ) {
			$goban = Goban::load( $_GET[ 'id' ] );
			$this->goban = $goban;
			return TRUE;
		}
		return FALSE;
	}
	public function exists( $id ) {
        return file_exists( Goban::data_file( $id ) );
    }
	
	
	/******************************************************************************
	   GOBAN MANIPULATION
	*******************************************************************************/
	public function create( $size ) {
		$this->goban = new Goban();
	    $this->goban->size = $size;
        $this->goban->save();
	}
	public function stones_coord_from_list( $list ) {
		$stones = array();
		foreach ( $list as $index => $stone ) {
			$x = $index % $this->goban->size + 1;
			$y = floor( $index / $this->goban->size ) + 1;
			if ( ! isset( $stones[ $x ] ) ) {
				$stones[ $x ] = array( );
			}
			$stones[ $x ][ $y ] = $stone;
		}
		return $stones;
	}
	public function update_stones( ) {
		$stones = $this->stones_coord_from_list( $_POST[ 'stones' ] );
		$this->goban->stones = $stones;
		$this->goban->save();
	}
	
	
	/******************************************************************************
	   STONE GETTER
	*******************************************************************************/
	public function stone_human_color( $x, $y ) {
		if ( ! isset( $this->goban->stones[ $x ][ $y ] ) ) return '';
		return ( $this->goban->stones[ $x ][ $y ] == 'X' ) ? 'black' : 'white';
	}
	public function stone_human_coord( $x, $y ) {
	    return chr( 64 + $x ) . ' - ' . $y;
	}

	
	/******************************************************************************
	   URL
	*******************************************************************************/
	public function edit_url( ) {
		return 'http://goban.fr/?id=' . $this->goban->id . '&edit=' . $this->goban->key;
	}
	public function view_url( ) {
		return 'http://goban.fr/?id=' . $this->goban->id;
	}
	public function is_goban_url( ) {
		return isset( $_GET[ 'id' ] );
	}
	public function is_edit_url( ) {
		return isset( $_GET[ 'edit' ] );
	}
	public function is_apply_edition_url( ) {
		return isset( $_POST[ 'stones' ] );
	}
	public function can_edit( ) {
		$this->edition = $_GET[ 'edit' ] == $this->goban->key;
		return $this->edition;
	}
}

?>