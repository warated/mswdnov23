<?php
// Arithmetic Operators
$a = 21;
$b = 2;
$intDiv = 8 /2;

echo '<h5>Arithmetic Operators </h5>';

printf('<p> %d + %d = %d</p>', $a, $b, $a + $b);
printf('<p> %d - %d = %d</p>', $a, $b, $a - $b);
printf('<p> %d * %d = %d</p>', $a, $b, $a * $b);
printf('<p> %d / %d = %.1f</p>', $a, $b, $a / $b);
printf('<p> %d %% %d = %.1f</p>', $a, $b, $a % $b);
printf('<p> %d ** %d = %d</p>', $a, $b, $a ** $b);
echo("8 / 2 = $intDiv, which is a " . gettype($intDiv));

echo '<h5>Increment and Decrement Operators</h5>';
$a = 0;
$b = 0;

printf('<p>a is %d. after ++a, a is %d</p>', $a, ++$a);
printf('<p>b is %d. after b++, a is %d</p>', $b, $b++);
echo("<p>b is $b</b>");

echo '<h5>Assignment With Operations</h5>';

$a = 1;

printf('<p>The Value of a is %d</p>', $a);
printf('<p>a+=5 = %d', $a+=5);
printf('<p>a-=4 = %d', $a-=4);

echo '<h5>Assignment By Value</h5>';
$a = 20;
printf('<p>a starts with the value %d</p>', $a);
$b = $a;
$b = 30;
printf('<p>After changing b, a contains %d</p>', $a);

echo '<h5>Assignment By Reference</h5>';
$a = 20;
printf('<p>a starts with the value %d</p>', $a);
$b = &$a;
$b = 30;
printf('<p>After changing b, a contains %d</p>', $a);


//Control Flow 
echo '<h5>IF Statements</h5';

$age = 30;
if ($age >= 18){
    echo '<p>You can drive a car</p>';

}
else{
    echo '<p>You are too young to drive a car.</p>';
}


echo '<h5>Multiple Outcomes</h5>';
$pizzaChoice = 2;

if ($pizzaChoice === 1) {
    echo '<p>Pizza Margherita</p>';
}else if ($pizzaChoice === 2) {
    echo '<p>Pizza Pepperoni</p>';
}elseif ($pizzaChoice === 3) {
    echo '<p>Pizza Mushroom</p>';
}else {
    echo '<p>Invalid pizza choice!</p>';
}

echo '<h5>Boolean Values</h5>';
$isRaining = false; 
if ($isRaining) {
    echo '<p>Better take an umbrella!</p>';
} else {
    echo '<p>Enjoy the sunny day!</p>';
}

echo '<h5>Logical Operators</h5>';
$beanWeight = 50;
$waterWeight = 200;
if ($beanweight >= 30 && $waterWeight >=150) {
    echo  '<p>Coffee machine working...</p>';
}   else {
    echo '<p>Please check beans and water!</p>';
}

$grindWeight = 15;
if ($beanWeight >= 30 || $grindWeight >= 20) {
    echo '<p>You have enough coffee</p>';
} else {
    echo '<p>You do not have enough coffee</p>';
}

$bingo = 90;
switch ($bingo) {
    case 1: echo '<p>By itself, number1</p>'; break;
    case 11: echo '<p>Long legs, number 11</p>'; break;
    case 90: echo '<p>The old woman, number 90</p>'; break;
    default: echo "<p>You got a $bingo </p>";
}

echo '<h5>Iteration (Looping)</h5>';
$fishingPermitExpire = 17;
$currentDay = 8;

while($curerentDay <= $fishingPermitExpires) {
    echo "<p>Fishing on day $currentDay</p>";
    $currentDay++;
}

$prospectPermitExpires = 17;
$currentDay = 8;
do {
    echo "<p>Prospecting on day $currentDay</p>";
    $currentDay++;
} while ($currentDay <= $prospectPermitExpires);

$diggingPermitExpires = 17;
for ($currentDay = 8; $currentDay <= $diggingPermitExpires; $currentDay++) {
    echo "<p>Digging on day $currentDay</p>";
}

$students = ['Valentino', 'Olga', 'Philipp', 'Keith'];
foreach($students as $student) {
    echo "<p>$student is a student!</p>";
}

?>