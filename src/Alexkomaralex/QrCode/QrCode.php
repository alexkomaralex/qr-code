<?php

namespace Alexkomaralex\QrCode;

use Alexkomaralex\QrCode\Renderer\RendererInterface;
use Alexkomaralex\QrCode\Exception\EmptyParameterException;
use Alexkomaralex\QrCode\Exception\InvalidParameterException;

class QrCode
{
    /**
     * @var string Text to encode
     */
    protected $text;
    /**
     * @var int Qr code image width
     */
    protected $width;
    /**
     * @var int Qr code image height
     */
    protected $height;

    /**
     * @var RendererInterface Qr code renderer
     */
    protected $renderer;

    /**
     * QrCode constructor.
     * @param string $text
     * @param int $width
     * @param int $height
     */
    public function __construct($text, $width, $height)
    {
        $this->setText($text);
        $this->setWidth($width);
        $this->setHeight($height);
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @param RendererInterface $renderer
     */
    public function setRenderer(RendererInterface $renderer) {
        $this->renderer = $renderer;
    }

    /**
     * @return mixed
     * @throws EmptyParameterException
     * @throws InvalidParameterException
     */
    public function generate() {
        $this->validate();
        return $this->renderer->render($this);
    }

    /**
     * @throws EmptyParameterException
     * @throws InvalidParameterException
     */
    protected function validate() {
        $text = $this->getText();
        $width = $this->getWidth();
        $height = $this->getHeight();

        if (empty($text)) {
            throw new EmptyParameterException('text should be defined');
        }
        if (empty($width)) {
            throw new EmptyParameterException('width should be defined');
        }
        if (empty($height)) {
            throw new EmptyParameterException('height should be defined');
        }
        if (!is_int($width)) {
            throw new InvalidParameterException('width should be int');
        }
        if (!is_int($height)) {
            throw new InvalidParameterException('height should be int');
        }

    }
}