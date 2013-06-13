<?php

namespace Album;

use Album\Model\AlbumTable;

class Module
{

    public function getAutoloaderConfig()
    {
        if (file_exists(__DIR__ . '/autoload_classmap.php')) {
            return array(
                'Zend\Loader\ClassMapAutoloader' => array(
                    __DIR__ . '/autoload_classmap.php',
                ));
        } else {
            return array(
                'Zend\Loader\StandardAutoloader' => array(
                    'namespaces' => array(
                        __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                    ),
                ),
            );
        }
    }

    public function getConfig()
    {
        return array_merge(
            include __DIR__ . '/config/module.config.php',
            include __DIR__ . '/config/router.config.php'
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Album\Model\AlbumTable' => function($sm)
                {
                    $dbAdapter = $sm->get('DbAdapter');
                    $table = new AlbumTable($dbAdapter);
//                    var_dump($table);
                    return $table;
                }
            )
        );
    }

}