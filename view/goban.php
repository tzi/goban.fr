<?php

$content = '<div class="goban ' . ( $edit_goban ? 'edit' : '' ) . '"><div class="board">';

for( $y = 1; $y <= $goban->size; $y++ ) {
    for( $x = 1; $x <= $goban->size; $x++ ) {

        $cell_classes = 'cell row' . $y . ' col' . $x;
        if ( $x == 1 ) $cell_classes .= ' first_col';
        else if ( $x == $goban->size ) $cell_classes .= ' last_col';
        if ( $y == 1 ) $cell_classes .= ' first_row';
        else if ( $y == $goban->size ) $cell_classes .= ' last_row';

        $content_classes = 'content';
        $content_attribute = '';
        $content_tag = 'span';
        if ( isset( $goban->stones[ $x ][ $y ] ) ) $content_classes .= ' stone '.$goban->stones[ $x ][ $y ];
        if ( $edit_goban ) {
            $content_tag = 'a';
            $content_attribute = ' href="javascript:;"';
            $content_classes .= ' action';
        }
        
        $content .= '<div class="' . $cell_classes . '">';
        $content .= '<' . $content_tag . ' class="' . $content_classes . '" ' . $content_attribute . '> </' . $content_tag . '>';
        $content .= '</div>';
    }
}
$content .= '</div></div>';

if ( $edit_goban ) {
    $content .= '<h2>Liens à retenir</h2>
<ul>
    <li>Partager avec vos amis : <a href="http://goban.fr?id=' . $goban->id . '">http://goban.fr?id=' . $goban->id . '</a></li>
    <li>Editer ce goban : <a href="http://goban.fr?id=' . $goban->id . '&key=' . $goban->key . '&edit=1">http://goban.fr?id=' . $goban->id . '&key=' . $goban->key . '&edit=1</a></li>
</ul>';
}

require( '../view/view.php' );

?>
