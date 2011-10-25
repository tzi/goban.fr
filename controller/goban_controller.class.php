<?php

require_once( '../model/goban.class.php' );

class GobanController {

    public $admin = FALSE;
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
    public function last_gobans( $count ) {
        $gobans = array();
        $max_id = Goban::max_id();
        for ( $i = $max_id; $i > ( $max_id - $count ) && $i > 0 ; $i-- ) {
            $goban = Goban::load( $i );
            if ( ( $this->admin && ! empty( $goban->stones ) &&  ! empty( $goban->title ) ) ||
                 ( ! $this->admin && $goban->home ) )
            {
                $gobans[] = $goban;
            } else {
                $count++;
            }			
        }
        return $gobans;
    }
	
	
	/******************************************************************************
	   GOBAN MANIPULATION
	*******************************************************************************/
	public function create( ) {
		$this->goban = new Goban();
		$this->goban->size = $_POST['new'];
		$this->goban->author = stripslashes( $_POST['author'] );
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
	public function stones_list( ) {
		$stones = array();
		foreach ( $this->goban->stones as $x => $col ) {
			foreach ( $col as $y => $stone ) {
				$index = ( $y - 1 ) * $this->goban->size + $x - 1;
				$stones[ $index ] = $stone;
			}
		}
		return $stones;
	}
	public function is_oeil( $x, $y ) {
		$middle = ceil( $this->goban->size / 2 );
		$side = min( ceil( $this->goban->size / 4 ), 3 );
		if ( ( $x == $middle || $x == $side || $x == ( $this->goban->size - $side ) ) && 
		     ( $y == $middle || $y == $side || $y == ( $this->goban->size - $side ) ) )
		{
			return true;
		}
		return false;
	}
	public function update( ) {
		$stones = $this->stones_coord_from_list( $_POST[ 'stones' ] );
		$this->goban->stones = $stones;
		if ( isset( $_POST[ 'title' ] ) ) $this->goban->title = stripslashes( $_POST[ 'title' ] );
		if ( isset( $_POST[ 'description' ] ) ) $this->goban->description = stripslashes( $_POST[ 'description' ] );
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
	public function edit_url( $goban = null ) {
		if ( $goban == null ) $goban = $this->goban;
		$url = 'http://goban.fr/?id=' . $goban->id . '&edit=' . $goban->key;
		if ( $this->admin ) {
			$url .= '&admin=coco';
		}
		return $url;
	}
	public function view_url( $goban = null ) {
		if ( $goban == null ) $goban = $this->goban;
		$url = 'http://goban.fr/?id=' . $goban->id;
		if ( $this->admin ) {
			$url .= '&admin=coco';
		}
		return $url;
	}
	public function is_create_url( ) {
		return isset( $_POST[ 'new' ] );
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