<?php

require_once __DIR__ . '/../vendor/autoload.php';
$autoloader = require __DIR__ . '/../vendor/autoload.php';
$autoloader->add('Alexkomaralex\\', __DIR__.'/../src/');

use Alexkomaralex\QrCode\QrCode;
use Alexkomaralex\QrCode\Renderer\GoogleChartsRenderer;

$image = false;

if (isset($_POST['postback'])) {
    $width = isset($_POST['width'])?((int) $_POST['width']):0;
    $height = isset($_POST['height'])?((int) $_POST['height']):0;
    $text = isset($_POST['text'])?($_POST['text']):'';

    $qrCode = new QrCode($text, $width, $height);
    $qrCode->setRenderer(new GoogleChartsRenderer());
    $image = $qrCode->generate();
}

?>
<?php if($image):?>
<?php
    header("Content-Type: image/png");
    echo $image;
?>
<?php else: ?>
<form action="" method="post">
    <input type="text" name="width" placeholder="Qr code width" value="">
    <input type="text" name="height"  placeholder="Qr code height" value="">
    <input type="text" name="text" placeholder="Qr code text" value="">
    <input type="submit"  name="postback" value="Generate">
</form>
<?php endif;?>


