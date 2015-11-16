<?php
$var1['apple'] = 'apple element';
$var1['pear'] = 'pear element';
print_r ($var1);
$var2 = array(1,2,3,4);
print_r ($var2);
$str1 = '34,56,67,89,05';
$var3 = explode(',', $str1);
print_r ($var3);
$str2 = implode(' and', $var3);
echo $str2
?>
