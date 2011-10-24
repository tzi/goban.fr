<?php

$goban = $goban_controller->goban;

$content = '<div class="goban ' . ( $goban_controller->edition ? 'edit' : '' ) . '"><div class="board">';

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
        if ( $goban_controller->stone_human_color( $x, $y ) ) $content_classes .= ' stone '.$goban_controller->stone_human_color( $x, $y );
        if ( $goban_controller->edition ) {
            $content_tag = 'a';
            $content_attribute = ' href="javascript:;" title="Case ' . $goban_controller->stone_human_coord( $x, $y ) . '"';
            $content_classes .= ' action';
        }
        
        $content .= '<div class="' . $cell_classes . '">';
        $content .= '<' . $content_tag . ' class="' . $content_classes . '" ' . $content_attribute . '> </' . $content_tag . '>';
        $content .= '</div>';
    }
}
$content .= '</div></div>';

if ( $goban_controller->edition ) {
    $content .= '<h2>Liens à retenir</h2>
<ul>
    <li>Partager avec vos amis : <a href="' . $goban_controller->view_url( ) . '">' . $goban_controller->view_url( )  . '</a></li>
    <li>Editer ce goban : <a href="' . $goban_controller->edit_url( ) . '">' . $goban_controller->edit_url( ) . '</a></li>
</ul>';
}

require( '../view/view.php' );

?>
