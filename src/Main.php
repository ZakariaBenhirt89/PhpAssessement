<?php
// entry point test
require_once __DIR__ . '/MyClass.php';

function haveRequirement($string){
    $length = strlen($string);
    return ($length >= 128 && $length <= 256);
}

$string = "function is used to split the string into an array of substrings, where each substring is 256 characters long (or less, for the final substring if the length of the string is not a multiple ";
$lorem_ipsum = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sac blandit arcu. Phasellus euismod tristique odio, a laoreet elit vestibulum id. Nam euismod congue odio, eget convallis nisi gravida in. Sed mollis viverra metus, vel convallis eros consectetur ac. Fusce id urna vel metus posuere viverra sed sit amet est. Sed nec interdum nisl, non auctor ex. Etiam vitae felis felis. Maecenas bibendum erat vel est elementum, quis eleifend tellus porttitor. Vestibulum et augue neque. Sed volutpat augue in nibh bibendum, vitae ullamcorper urna malesuada. Vivamus placerat dolor ac ex suscipit, nec ullamcorper nisi vehicula.";
$lorem_ipsum_560_chars = substr(str_repeat($lorem_ipsum, ceil(560 / strlen($lorem_ipsum))), 0, 560);
$chunks = str_split($lorem_ipsum_560_chars, 277);
print_r($chunks);
print_r("\n");
$myClass = new MyClass();
$fragments = array('Lorem ipsum', 'dolor sit amet,', 'consectetur adipiscing elit.', 'Proin pharetra massa', 'at semper ullamcorper');
$segements = $myClass->assemble_segments($fragments);
print_r($segements);
foreach($segements as $seg){
    $len  += strlen($seg);
    print_r($len."\n");
}
?>
