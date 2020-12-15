<?php ob_start();?>

<div id="target"></div>
<input type="text" id="message" maxlength="255"/>
<input type="button" id="submit"/>

<div id="users"></div>

<select name="status" id="selectStatus">
<option value="0">Absent</option>
<option value="1">Occupé</option>
<option value="2">En ligne</option>
</select>

<?php
$content = ob_get_clean();
require 'template.php';
?>
