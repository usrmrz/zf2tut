<?php

namespace Blog\Form\View\Helper\Captcha;

use DirectoryIterator;
use Zend\Form\View\Helper\Captcha\AbstractWord;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;
use Blog\Form\View\Helper\Captcha\CustomCaptcha as CaptchaAdapter;

class ViewHelperCaptcha extends AbstractWord
{
    public function render(ElementInterface $element)
    {
        $this->setSeparator('<br />');

        $captcha = $element->getCaptcha();

        if ($captcha === null || !$captcha instanceof CaptchaAdapter) {
            throw new Exception\DomainException(sprintf(
                '%s requires that the element has a "captcha" attribute of type Zend\Captcha\Dumb; none found',
                __METHOD__
            ));
        }
//        $captcha->setExpiration(0);
        $captcha->setGcFreq(1);
        $captcha->generate();
        $imgAttributes = array(
            'width'  => $captcha->getWidth(),
            'height' => $captcha->getHeight(),
            'alt'    => $captcha->getImgAlt(),
            'src'    => $captcha->getImgUrl() . $captcha->getId() . $captcha->getSuffix(),
        );
        $closingBracket = $this->getInlineClosingBracket();
        $img = sprintf(
            '<img %s%s' . PHP_EOL,
            $this->createAttributesString($imgAttributes),
            $closingBracket
        );
//        var_dump($captcha->getExpiration());
//        var_dump($closingBracket);


        $position = $this->getCaptchaPosition();
        $separator = $this->getSeparator();
        $captchaInput = $this->renderCaptchaInputs($element);

//        $messageTemplates = array(
//        self::MISSING_VALUE => 'Empty captcha value',
//        self::MISSING_ID    => 'Captcha ID field is missing',
//        self::BAD_CAPTCHA   => 'Captcha value is wrong',
//    );

        $pattern = '<div class="captcha_image">
            %s</div>' . PHP_EOL .
            '%s<div class="captcha_input">
            %s</div>' . PHP_EOL;
        if ($position == self::CAPTCHA_PREPEND) {
            return sprintf($pattern, $captchaInput, $separator, $img);
        }
        return sprintf($pattern, $img, $separator, $captchaInput);


    }

    public function gc($captcha){
        $imgdir = $captcha->getImgDir();
        if (!$imgdir || strlen($imgdir) < 2) {
            // safety guard
            return;
        }

//        $suffixLength = strlen($captcha->suffix);
        foreach (new DirectoryIterator($imgdir) as $file) {
            if (!$file->isDot() && !$file->isDir()) {
                if (file_exists($file->getPathname())) {
                    // only deletes files ending with $this->suffix
//                    if (substr($file->getFilename(), -($suffixLength)) == $this->suffix) {
                    unlink($file->getPathname());
//                    }
                }
            }
        }

    }
}