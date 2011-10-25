<?php

$goban = $goban_controller->goban;

$main_content = '<section>
<div class="goban goban_' . $goban->size . ' ' . ( $goban_controller->edition ? 'edit' : '' ) . '">';
if ( $goban_controller->edition ) {
    $main_content .= '<form method="POST" action="' . $goban_controller->edit_url( ) . '">';
}
$main_content .= '<div class="board">';

for( $y = 1; $y <= $goban->size; $y++ ) {
    for( $x = 1; $x <= $goban->size; $x++ ) {

        $cell_classes = 'cell row' . $y . ' col' . $x;
		if ( $goban_controller->is_oeil( $x, $y ) ) $cell_classes .= ' oeil';
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
    foreach( $goban_controller->stones_list() as $index => $stone ) {
		$main_content .= '<input type="hidden" name="stones[' . $index . ']" id="stones_' . $index . '" value="' . $stone . '" />';
	}
    if ( empty( $goban->stones ) ) {
        $cancel_href = '/';
    } else {
    	$cancel_href = $goban_controller->view_url( );
    }
    $main_content .= '
	<fieldset>
		<div class="clearfix">
			<label for="title">Titre</label>
			<div class="input">
				<input type="text" size="30" name="title" id="title" class="xlarge" value="' . $goban->title . '" >
			</div>
		</div>
		<div class="clearfix">
			<label for="description">Description</label>
			<div class="input">
				<textarea rows="2" name="description" id="description" class="xlarge">' . $goban->description . '</textarea>
				<span class="help-block">
					Vous ne pouvez pas mettre en forme le texte.
				</span>
			</div>
		</div>';
    if ( $goban_controller->admin ) {
        $main_content .= '
		<div class="clearfix">
            		<label for="prependedInput2">Prepended checkbox</label>
    			<div class="input">
      				<div class="input-prepend">
        				<label class="add-on"><input type="checkbox" value="" id="" name=""></label>
      				</div>
    			</div>
  		</div>';
    }
    $main_content .= '		
		<div class="actions">
                        <a href="' . $cancel_href  . '" class="btn">Annuler</a>&nbsp;
			<input type="submit" value="Sauvegarder" class="btn primary">
		</div>
	</fieldset>
</form>
</section>
<section>
    <div class="page-header">
        <h2>Liens à retenir</h2>
    </div>
    <ul>
        <li>Partager avec vos amis : <a href="' . $goban_controller->view_url( ) . '">' . $goban_controller->view_url( )  . '</a></li>
        <li>Editer ce goban : <a href="' . $goban_controller->edit_url( ) . '">' . $goban_controller->edit_url( ) . '</a></li>
    </ul>';
} else {
    if ( $goban->title ) {
	    $title = $goban->title;
		$main_content .= '<h3>
			' . $goban->title;
		if ( $goban->author ) {
			$main_content .= '&nbsp;&nbsp;&nbsp;<small>par ' . $goban->author . '</small>';
		}
		$main_content .= '</h3>';
	}
	if ( $goban->description ) {
		$main_content .= '<div class="well">' . nl2br( $goban->description ) . '</div>';
	}
	$main_content .= '
	<div class="actions">
		<a href="/" class="btn">Retour</a>
	</div>';
}
$main_content .= '</div>
</section>';

require( '../view/view.php' );

?>
