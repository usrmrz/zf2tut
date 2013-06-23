<?php

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Model\Album;
use Album\Form\AlbumForm;

class AlbumController extends AbstractActionController
{
    protected $albumTable;
//    protected $artistTable;

    public function getAlbumTable()
    {
        if (!$this->albumTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Album\Model\AlbumTable');
        }
//        var_dump($this->albumTable);
        return $this->albumTable;
    }

//    public function getArtistTable()
//    {
//        if(!$this->artistTable){
//            $sm = $this->getServiceLocator();
//            $this->artistTable = $sm->get('Album\Model\ArtistTable');
//        }
//        return $this->artistTable;
//    }

    public function indexAction()
    {
//        var_dump($this->getAlbumTable()->fetchAll());
        return new ViewModel(array(
            'albums' => $this->getAlbumTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new AlbumForm();
        $form->get('submit')->setAttribute('value', 'Add album');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $album = new Album();
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()){
                $album->exchangeArray($form->getData());
                $this->getAlbumTable()->saveAlbum($album);

                return $this->redirect()->toRoute('album');
            }
        }

        return array('form' => $form);

    }

    public function editAction()
    {

    }

    public function deleteAction()
    {

    }
}