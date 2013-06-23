<?php

namespace Blog\Form\View\Helper\Captcha;

use Zend\Captcha\Image as ZendCaptchaImage;

class CustomCaptcha extends ZendCaptchaImage
{

    protected $messageTemplates = array(
        self::MISSING_VALUE => 'Введите каптчу',
        self::MISSING_ID    => 'Поле ID отсутствует',
        self::BAD_CAPTCHA   => 'Неверно введено значение',
    );
    public function getHelperName(){
        return 'viewhelpercaptcha';
    }
}