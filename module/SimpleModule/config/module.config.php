<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'SimpleModule\Controller\Index' => 'SimpleModule\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'simple' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/simple',
                    'defaults' => array(
                        'controller' => 'SimpleModule\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'simple-module/index/index' => __DIR__ . '/../view/simple/index.phtml',
        ),
        'template_path_stack' => array(
            'simple' => __DIR__ . '/../view',
        ),
    ),
);