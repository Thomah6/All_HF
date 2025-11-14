<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>EXOS</h1>
    <h2>EXO 1</h2>
    <?php
function firstUpperCase($string){
    return ucwords($string);
}
echo firstUpperCase("hello world");
?>
<h2>EXO 2</h2>
<?php
function longestWord($string){
    $words = explode(' ',$string);
    $len = 0;
    foreach($words as $word){
        if(strlen($word) > $len){
            $len = strlen($word);
        } 
    }
    return $len;
}
echo longestWord("hello0 world");
?>
<h2>EXO 3</h2>
<?php
function largestNumber($arr){
    $largest = 0;
    foreach($arr as $ar){
        if($ar > $largest){
            $largest = $ar;
        }
    }
    return $largest;
} 

echo largestNumber([20, 32, 97]);
?>

<h2>EXO 4</h2>
<?php

function confirmEnd($string, $end){
    return str_ends_with($string, $end);
}
echo confirmEnd("hello world", "ld");
?>

<h2>EXO 5</h2>
<?php
function truncate($str, $num){
if(strlen($str)>$num){
    return substr($str, 0, $num) . '...';
}else{
    return $str;
}    
}
echo truncate("hello world", 5);


?>
<h2>EXO 6</h2>
<?php

function findElement($arr, $func){
    $result = 20;
    foreach($arr as $ar){
        if($func($ar)){
            $result = $ar;
            break;
        }
    }
    return $result;
}
echo findElement([20, 32, 97], function($num){
    return $num > 20;
});
?>


<h2>EXO 7</h2>
<?php

?>

<h2>EXO 13</h2>

<?php
function chunkArrayInGroups($arr, $size) {
    $newArray = [];
    while(count($arr) > 0) {
        $chunk = array_slice($arr, 0, $size);
        $newArray[] = $chunk;
        $arr = array_slice($arr, $size);
    }
    return $newArray;
}

print_r(chunkArrayInGroups([1, 2, 3, 4, 5, 6], 2));

?>
</body>
</html>