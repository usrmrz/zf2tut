<?php

namespace Blog\Form;

use Zend\Form\Form;
//use Zend\Form\Element;
use Zend\Form\Element\Captcha;
//use Zend\Form\Element\Select;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

use Blog\Form\View\Helper\Captcha\CustomCaptcha;


class AlbumForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->setAttribute('method', 'post')
            ->setHydrator(new ClassMethodsHydrator(false))
            ->setInputFilter(new InputFilter());

        $this->add(array(
            'type'    => 'Blog\Form\AlbumFieldset',
            'options' => array(
                'use_as_base_fieldset' => true,
            )
        ));

        $dirdata = './data';

        //Create custom captcha class
        $captchaImage = new CustomCaptcha(array(
            'font'           => $dirdata . '/fonts/Roboto-Regular.ttf',
            'width'          => 120,
            'height'         => 50,
            'fsize'          => 20,
            'wordLen'        => 3,
            'dotNoiseLevel'  => 1,
            'lineNoiseLevel' => 1
        ));
        $captchaImage->setImgDir('public/img/captcha/');
        $captchaImage->setImgUrl('/img/captcha/');
        $captchaImage->setImgAlt('Подтвердите, что вы не робот');

//          'public/img/captcha/' '/img/captcha/' http://zf2tut/img/captcha/05a8a08949b1932eb2aec78f9ac98688.png
        $this->add(array(
            'type'       => 'Zend\Form\Element\Captcha',
            'name'       => 'captcha',
            'options'    => array(
//                'label' => 'Подтвердите, что вы не робот',
                'captcha' => $captchaImage,
            ),
            'attributes' => array(
                'class' => 'span2',
            )
        ));

        $this->add(array(
            'name'       => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'class' => 'btn btn-primary',
            )
        ));
    }
}