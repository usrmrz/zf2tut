<?php

namespace Blog;

use Blog\Model\AlbumMapper;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
//            'invokables' => array(
//                'Blog\Form\Album' => 'Blog\Form\AlbumForm'
//            ),
            'factories' => array(
                'Blog\Model\AlbumMapper' => function($sm)
                {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new AlbumMapper($dbAdapter);

                    return $table;
                }),
        );
    }

    public function getFormElementConfig()
    {
        return array(
//            'invokables' => array(
//                'Blog\Form\Album' => 'Blog\Form\Album'
//            )
        );
    }
}