<?php

namespace Blog;

use Blog\Model\AlbumMapper;
use Blog\Model\ArtistMapper;

//use Blog\Model\Album as AlbumEntity;
//use Blog\Model\Artist as ArtistEntity;

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
            'invokables' => array(
                'Blog\Form\AlbumForm' => 'Blog\Form\AlbumForm'
            ),

            'factories' => array(

//                'Blog\Model\CommonMapper'  => function($sm)
//                {
//                    $dbAdapter = $sm->get('DbAdapter');
//                    $commonMapper = new CommonMapper($dbAdapter, $table = null);
//                    return $commonMapper;
//                },

                'Blog\Model\AlbumMapper' => function($sm)
                {
                    $dbAdapter = $sm->get('DbAdapter');
                    $albumMapper = new AlbumMapper($dbAdapter, $table = null);
                    return $albumMapper;
                },

                'Blog\Model\ArtistMapper' => function($sm)
                {
                    $dbAdapter = $sm->get('DbAdapter');
                    $artistMapper = new ArtistMapper($dbAdapter, $table = null);
                    return $artistMapper;
                }

            ));
    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                'formelementerrors' => 'Blog\Form\View\Helper\FormElementErrors',
                'viewhelpercaptcha' => 'Blog\Form\View\Helper\Captcha\ViewHelperCaptcha',
            ),
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