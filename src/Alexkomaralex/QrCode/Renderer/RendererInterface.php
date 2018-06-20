<?php

namespace Alexkomaralex\QrCode\Renderer;

use Alexkomaralex\QrCode\QrCode;

interface RendererInterface
{
    /**
     * @param QrCode $qrCode
     * @return mixed
     */
    public function render(QrCode $qrCode);
}