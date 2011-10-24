<?php

$content  = '<h1>Goban.fr</h1>
<form action="?">
    <select name="new">
        <option value="9">9</option>
        <option value="13">13</option>
        <option value="19">19</option>
    </select>
    <button type="submit">Nouveau Goban</button>
</form>';

require( 'view/view.php' );

?>
