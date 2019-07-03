<?php

require_once __DIR__ . '/../vendor/autoload.php';

use LengthConverter\LengthConverter;

$converter = new LengthConverter(1);

echo $converter->from('inchs')->to('cm')->show() . '<br />';
echo $converter->from('m')->to('mm')->show(0, ',', '.') . '<br />';
