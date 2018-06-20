<?php

namespace Alexkomaralex\QrCode\Renderer;

use Alexkomaralex\QrCode\QrCode;
use Alexkomaralex\QrCode\Exception\HttpException;

class GoogleChartsRenderer implements RendererInterface
{

    const ROOT_URL = 'https://chart.googleapis.com/chart';

    /**
     * @var array $options
     */
    private $options;

    /**
     * @param QrCode $qrCode
     * @return mixed
     * @throws HttpException
     */
    public function render(QrCode $qrCode)
    {
        $this->prepareOptions($qrCode);
        $result = $this->send();
        return $result;
    }

    /**
     * @param QrCode $qrCode
     */
    protected function prepareOptions(QrCode $qrCode) {
        $this->options = [
            "cht" => "qr",
            "chs" => $qrCode->getWidth().'x'.$qrCode->getHeight(),
            "chl" => $qrCode->getText(),
            "chld" => "H"
        ];
    }

    /**
     * @return mixed
     * @throws HttpException
     */
    protected function send() {

        $queryString = http_build_query($this->options);
        $ch = curl_init();
        if (mb_strlen($queryString)<=2000) {
            curl_setopt($ch, CURLOPT_URL, self::ROOT_URL.'?'.$queryString);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        } else {
            curl_setopt($ch, CURLOPT_URL, self::ROOT_URL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $queryString);
        }
        try {
            $content = curl_exec($ch);
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage());
        }

        curl_close($ch);
        return $content;
    }
}