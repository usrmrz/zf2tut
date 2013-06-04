<?php

namespace Blog\Helper;

use Zend\View\Helper\AbstractHelper;

class RenderForm extends AbstractHelper
{
    public function __invoke($form)
    {
        $form->prepare();
        $out = $this->view->form()->openTag($form);
        $elements = $form->getElements();
        foreach ($elements as $element) {
            $out .= $this->view->formRow($element);
        }
        $out .= $this->view->form()->closeTag($form);
        return $out;
    }
}