<?php
echo '<pre>';
$g = get_defined_functions();
print_r($g['internal']);
echo '</pre>';
?>