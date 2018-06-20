<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Alexkomaralex\QrCode\QrCode;
use Alexkomaralex\QrCode\Exception\EmptyParameterException;

final class QrCodeTest extends TestCase
{
    public function testCannotBeGeneratedFromEmptyWidth()
    {
        $QrCode = new QrCode('Test', 0, 100);
        $this->expectException(EmptyParameterException::class);

        $QrCode->generate();
    }
    public function testCannotBeGeneratedFromEmptyHeight()
    {
        $QrCode = new QrCode('Test', 100, 0);
        $this->expectException(EmptyParameterException::class);

        $QrCode->generate();
    }
    public function testCannotBeGeneratedFromEmptyText()
    {
        $QrCode = new QrCode('', 100, 100);
        $this->expectException(EmptyParameterException::class);

        $QrCode->generate();
    }
}