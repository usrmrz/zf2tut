<?php

return array(
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Главная',
                'route' => 'home',
            ),

            array(
                'label' => 'Альбомы',
                'route' => 'blog',
                'pages' => array(
                    array(
                        'label' => 'Добавить',
                        'route' => 'blog',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'Редактировать',
                        'route' => 'blog',
                        'action' => 'edit',
                        'pages' => array(
                            array(
                                'label' => 'Номер',
                                'route' => 'id',
                                'action' => 'id',
                            ),
                        ),
                    ),
                    array(
                        'label' => 'Удалить',
                        'route' => 'blog',
                        'action' => 'delete',
                    ),
                ),
            ),
            array(
                'label' => 'Simple Module',
                'route' => 'SanCaptcha',
            ),

//            array(
//                'label' => 'Старый',
//                'route' => 'album',
//                'pages' => array(
//                    array(
//                        'label' => 'Add',
//                        'route' => 'album',
//                        'action' => 'add',
//                    ),
//                    array(
//                        'label' => 'Edit',
//                        'route' => 'album',
//                        'action' => 'edit',
//                    ),
//                    array(
//                        'label' => 'Delete',
//                        'route' => 'album',
//                        'action' => 'delete',
//                    ),
//                ),
//            ),
        ),
    ),
);