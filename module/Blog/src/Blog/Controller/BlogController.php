<?php

namespace Blog\Controller;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Blog\Model\Album;
use Blog\Form\AlbumForm;

class BlogController extends AbstractActionController
{
    protected $albumMapper;

    public function getAlbumTable()
    {
        if (!$this->albumMapper) {
            $sm = $this->getServiceLocator();
            $this->albumMapper = $sm->get('Blog\Model\AlbumMapper');
        }
        return $this->albumMapper;
    }

    public function indexAction()
    {
        return  new ViewModel(array(
           'albums' =>  $this->getAlbumTable()->fetchAll(),
        ));

//        $album = $this->getAlbumTable()->getAlbum($id);
//        echo var_dump($album);
//        return $album;//array(
//            'album' => $album,
//            'id' => $id,
//        );
    }

    public function addAction()
    {
        $form = new AlbumForm();


//        $form->bind($album);
        $request = $this->getRequest();

        if ($request->isPost()) {
//            $album = new Album();
//            echo var_dump($request);
            $form->setData($request->getPost());

            if ($form->isValid()) {
                echo var_dump($form);
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
//        $id = (int) $this->params()->fromRoute('id', 0);
//        if(!$id){
//            return $this->redirect()->toRoute('album', array(
//                'action' => 'add'
//            ));
//        }
//        $album = $this->getAlbumTable()->getAlbum($id);
//
//        $form = new AlbumForm();
//        $form->bind($album);
//        $form->get('submit')->setAttribute('value', 'Edit');
//
//        $request = $this->getRequest();
//        if ($request->isPost()){
//            $form->setInputFilter($album->getInputFilter());
//            $form->setData($request->getPost());
//            if($form->isValid()){
//                $this->getAlbumTable()->saveAlbum($album);
//
//                return $this->redirect()->toRoute('album');
//            }
//        }
//
//        return array(
//            'id' => $id,
//            'form' => $form,
//        );
    }

    public function deleteAction()
    {
//        $id = (int)$this->params()->fromRoute('id');
//        if(!$id){
//            return $this->redirect()->toRoute('album');
//        }
//
//        $request = $this->getRequest();
//        if($request->isPost()){
//            $del = $request->getPost()->get('del', 'Нет');
//            if($del == 'Да'){
//                $id = (int)$request->getPost()->get('id');
//                $this->getAlbumTable()->deleteAlbum($id);
//            }
//
//            return $this->redirect()->toRoute('album');
//        }
//        return array(
//            'id' => $id,
//            'album' => $this->getAlbumTable()->getAlbum($id),
//        );
    }
}