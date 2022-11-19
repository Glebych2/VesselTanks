<?php

session_start();

include("generator.php");

// создаем случайное число и сохраняем в сессии
$randomnr = generate_code();
$_SESSION['randomnr2'] = md5($randomnr);
//Устанавливаем отображение сообщений об ошибках
ini_set ("display_errors", "1");
error_reporting(E_ALL);

//Устанавливаем тип содержимого
header('content-type: image/png');

//Определяем размеры изображения
//125px width, 125px height
$im = imagecreate(120, 38);

//Выбираем цвет фона
$blue = imagecolorallocate($im, rand(160, 220), rand(160, 220), rand(160, 220));


$grey = imagecolorallocate($im, rand(100, 140), rand(100, 140), rand(100, 140));
$black = imagecolorallocate($im, rand(0, 50), rand(0, 50), rand(0, 80));
//путь к шрифту:


$font = "./ComicRelief.ttf";

//рисуем текст:
imagettftext($im, 17, rand(-5, 5), 22, 24, $grey, $font, $randomnr);

imagettftext($im, 17, rand(-5, 5), 15, 26, $black, $font, $randomnr);

// Заполням изображение линиями
$line_color = imagecolorallocate($im, rand(0, 80), rand(0, 80), rand(0, 80));
for ($i=0;$i<10;$i++) { imageline($im,0,rand()%50,200,rand()%50,$line_color); }
// Заполням изображение точками
$pixel_color = imagecolorallocate($im, rand(0, 50), rand(0, 50), rand(160, 220));
for ($i=0;$i<1000;$i++) { imagesetpixel($im,rand()%200,rand()%50,$pixel_color); }

//imagestring($im, 5, 10, 10, $randomnr, $grey);

//Сохраняем файл в формате png и выводим его
imagegif($im);

//Чистим использованную память
imagedestroy($im);

//$randomnr = rand(1000, 9999);
//$_SESSION['randomnr2'] = md5($randomnr);
////var_dump('hello'.$_SESSION['randomnr2']);
////создаем изображение
//$im = imagecreatetruecolor(100, 38);
//
////цвета:
//$white = imagecolorallocate($im, 255, 255, 255);
//$grey = imagecolorallocate($im, 128, 128, 128);
//$black = imagecolorallocate($im, 0, 0, 0);
//
//imagefilledrectangle($im, 0, 0, 200, 35, $black);
//
////путь к шрифту:
//
//$font = FULL_SITE_ROOT.'/assets/upload/fonts/karate/Karate.ttf';
//
////рисуем текст:
//imagettftext($im, 35, 0, 22, 24, $grey, $font, $randomnr);
//
//imagettftext($im, 35, 0, 15, 26, $white, $font, $randomnr);
//
//// предотвращаем кэширование на стороне пользователя
//header("Expires: Wed, 1 Jan 1997 00:00:00 GMT");
//header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
//header("Cache-Control: no-store, no-cache, must-revalidate");
//header("Cache-Control: post-check=0, pre-check=0", false);
//header("Pragma: no-cache");
//
////отсылаем изображение браузеру
//header("Content-type: image/gif");
//imagegif($im);
//imagedestroy($im);

