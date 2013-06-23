<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'BlogController' => 'Blog\Controller\BlogController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'blog' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/blog[/:action][/:id]',
                    'constraints' => array(
                        'article' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'BlogController',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_map' => array(
            'blog/blog/index' => __DIR__ . '/../view/blog/index.phtml',
            'blog/blog/add' => __DIR__ . '/../view/blog/add.phtml',
            'blog/blog/edit' => __DIR__ . '/../view/blog/edit.phtml',
            'blog/blog/delete' => __DIR__ . '/../view/blog/delete.phtml',
        ),
        'template_path_stack' => array(
            'blog' => __DIR__ . '/../view',
        ),
    ),

//    'view_helpers' => array(
//        'invokables' => array(
            // generic view helpers
//            'truncate' => 'Zucchi\View\Helper\Truncate',

            // form based view helpers
//            'renderForm' => 'Blog\View\Helper\RenderForm',
//            'bootstrapRow' => 'Zucchi\Form\View\Helper\BootstrapRow',
//            'bootstrapCollection' => 'Zucchi\Form\View\Helper\BootstrapCollection',
//        ),
//    ),
);