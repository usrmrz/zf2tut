<?php

namespace Blog\Form;

use Zend\Form\Form;
//use Zend\Form\Element;
//use Zend\Form\Element\Captcha;
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
            'dotNoiseLevel'  => 50,
            'lineNoiseLevel' => 3,
        ));
        $captchaImage->setImgDir('public/img/captcha/');
        $captchaImage->setImgUrl('/img/captcha/');
//        $captchaImage->setImgDir($dirdata . '/captcha');
//        echo var_dump($captchaImage);
//        $captchaImage->setImgUrl('ROOT_PATH' . $dirdata . '/captcha');
        $captchaImage->setImgAlt('Подтвердите, что вы не робот');

//        echo var_dump(ZF2Path);
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
//        $imgDir = $captchaImage->getImgDir();
//        var_dump($imgDir);

//        $file = $fileList[2];
//        var_dump($file);
//        if (file_exists($file) == true) {
//            unlink($file);
//        }
        $this->add(array(
            'name'       => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'class' => 'btn btn-primary',
            )
        ));
    }
}