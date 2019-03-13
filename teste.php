<?php


$data = new DateTime();
$fuso = new DateTimeZone('America/Sao_Paulo');
$data->setTimezone($fuso);

echo $data->format("Y-m-d") . "<br>";
echo $data->format("h:i:s");