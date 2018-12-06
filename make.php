<?php
require_once './vendor/autoload.php';
use Gregwar\Captcha\CaptchaBuilder;

$target = (isset($argv[1])) ? $argv[1] : null;
$src = explode("\n", file_get_contents('./data.txt'));
foreach ($src as $i => $s) {
    if (empty($s)) {
        continue;
    }
    if (!is_null($target) && $i != $target) {
        continue;
    }
    makeImage($s, "./img/{$i}.jpg");
}

function makeImage($str, $filename)
{
    $builder = new CaptchaBuilder($str);
    $builder->setMaxFrontLines(0);
    $builder->setMaxBehindLines(0);
    $builder->setBackgroundColor(255, 255, 255);
    $builder->setIsVertical(true);
    $builder->setTextColor(1, 1, 1);
    $builder->build(250, 350);
    $builder->save($filename);
}
