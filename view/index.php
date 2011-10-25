<?php

$left_content  = '<p>Bienvenu !</p>';
$main_content = '
<form action="?">
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
</form>';

require( '../view/view.php' );

?>
