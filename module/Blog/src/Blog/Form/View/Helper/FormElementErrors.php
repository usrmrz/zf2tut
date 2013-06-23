<?php

namespace Blog\Form\View\Helper;

use Zend\Form\View\Helper\FormElementErrors as OriginalFormElementErrors;

class FormElementErrors extends OriginalFormElementErrors
{
    protected $messageCloseString = '</li></ul>';
    protected $messageOpenFormat = '<ul%s><li class="error-open">';
    protected $messageSeparatorString = '</li><li class="error-open">';
    protected $attributes = array(
//        'class' => 'help-inline',
    );
}