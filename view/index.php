<?php

$main_content = '
<section>
	<p><a href="/">Goban.fr</a> vous permet de sauvegarder une partie de Go.</p>
	<p>Une fois sauvegardé, vous pouvez alors facilement le partager avec vos amis.</p>
</section>
<section>
	<div class="page-header">
		<h2>Derniers Goban sauvegardés</h2>
	</div>
	<ul>';
foreach ( $goban_controller->last_gobans( 3 ) as $goban) {	
	$main_content .= '<li><a href="' . $goban_controller->view_url( $goban ) . '">' . $goban->title . '</a></li>';
}
$main_content .= '</ul>
</section>
<section>
	<div class="page-header">
		<h2>Créer un nouveau Goban</h2>
	</div>
	<form method="post">
		<div class="clearfix">
			<label for="author">Votre pseudo</label>
			<div class="input">
				<input type="text" size="30" name="author" id="author" class="large" value="" >
			</div>
		</div>
		<div class="clearfix">
			<label for="stackedSelect">Taille</label>
			<div class="input">
				<select name="new">
					<option value="9">9</option>
					<option value="13">13</option>
					<option value="19">19</option>
				</select>
			</div>
		</div>
		<div class="actions">
			<button type="submit" class="btn primary">Nouveau Goban</button>
		</div>
	</form>
</section>';

require( '../view/view.php' );

?>
