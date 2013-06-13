<?php

return array(
    'controllers'  => array(
        'invokables' => array(
            'AlbumController' => 'Album\Controller\AlbumController',
        ),
    ),

    'view_manager' => array(
        'template_map'        => array(
            'album/album/index'  => __DIR__ . '/../view/album/index.phtml',
            'album/album/add'    => __DIR__ . '/../view/album/add.phtml',
            'album/album/edit'   => __DIR__ . '/../view/album/edit.phtml',
            'album/album/delete' => __DIR__ . '/../view/album/delete.phtml',
        ),
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view',
        ),
    ),
);