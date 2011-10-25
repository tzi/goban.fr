<?php

class Goban {

    public $id;
    public $key;
    public $stones = array();
    public $author;
    public $title;
    public $description;
    public $goban;
    static public $data_folder = '../data/goban/';


    public function __construct() {
        $this->key = $this->generate_key();
    }


    public function generate_key() {
        $allowed_chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_@$%*";
        $key = '';
        for( $i = 1; $i <= 6; $i++ ) {
            $key .= $allowed_chars[ rand( 0, strlen( $allowed_chars ) ) ];
        }
        return $key;
    }


    public function generate_id() {
        return self::max_id() + 1; 
    }


    static public function max_id() {
        $num = 0;
        $folder = opendir( self::$data_folder );
        while( $entry = readdir( $folder ) ) {
            if( is_file( self::$data_folder . '/' . $entry ) ) $num++;
        }
        closedir( $folder );
        return $num; 
    }


    public function save() {
        if ( $this->id == null ) {
            $this->id = $this->generate_id();
        }
        $seed = serialize( $this );
        file_put_contents( $this->data_file( $this->id ), $seed );
    }

    
    static public function load( $id ) {
        $seed = file_get_contents( self::data_file( $id ) );
        return unserialize( $seed );
    }


    static public function data_file( $id ) {
        return self::$data_folder . $id . '.txt';
    }

}

?>
