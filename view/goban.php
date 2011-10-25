<?php

$goban = $goban_controller->goban;

$main_content = '<div class="goban ' . ( $goban_controller->edition ? 'edit' : '' ) . '">';
if ( $goban_controller->edition ) {
    $main_content .= '<form method="POST" action="' . $goban_controller->edit_url( ) . '">';
}
$main_content .= '<div class="board">';

for( $y = 1; $y <= $goban->size; $y++ ) {
    for( $x = 1; $x <= $goban->size; $x++ ) {

        $cell_classes = 'cell row' . $y . ' col' . $x;
        if ( $x == 1 ) $cell_classes .= ' first_col';
        else if ( $x == $goban->size ) $cell_classes .= ' last_col';
        if ( $y == 1 ) $cell_classes .= ' first_row';
        else if ( $y == $goban->size ) $cell_classes .= ' last_row';

        $main_content_classes = 'content';
        $main_content_attribute = '';
        $main_content_tag = 'span';
        if ( $goban_controller->stone_human_color( $x, $y ) ) $main_content_classes .= ' stone '.$goban_controller->stone_human_color( $x, $y );
        if ( $goban_controller->edition ) {
            $main_content_tag = 'a';
            $main_content_attribute = ' href="javascript:;" title="Case ' . $goban_controller->stone_human_coord( $x, $y ) . '"';
            $main_content_classes .= ' action';
        }
        
        $main_content .= '<div class="' . $cell_classes . '">';
        $main_content .= '<' . $main_content_tag . ' class="' . $main_content_classes . '" ' . $main_content_attribute . '> </' . $main_content_tag . '>';
        $main_content .= '</div>';
    }
}
$main_content .= '</div>';

if ( $goban_controller->edition ) {
    $main_content .= '
	<div class="actions">
		<input type="submit" value="Sauvegarder" class="btn primary">&nbsp;
		<a href="' . $goban_controller->view_url( )  . '" class="btn">Retour</a>
	</div>	
</form>
<h2>Liens à retenir</h2>
<ul>
    <li>Partager avec vos amis : <a href="' . $goban_controller->view_url( ) . '">' . $goban_controller->view_url( )  . '</a></li>
    <li>Editer ce goban : <a href="' . $goban_controller->edit_url( ) . '">' . $goban_controller->edit_url( ) . '</a></li>
</ul>';
}
$main_content .= '</div>';

require( '../view/view.php' );

?>
