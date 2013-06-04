<?php

namespace Blog\Controller;

//use Zend\ServiceManager\ServiceLocatorInterface;
//use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Blog\Model\Album;
use Blog\Model\Artist;
use Blog\Form\AlbumForm;

//use Blog\Form\AlbumFieldset;
//use Blog\Form\ArtistFieldset;

//use Zend\InputFilter\BaseInputFilter;

class BlogController extends AbstractActionController
{
    protected $albumMapper;
    protected $artistMapper;


    public function getAlbumMapper()
    {
        if (!$this->albumMapper) {
            $sm = $this->getServiceLocator();
//            echo var_dump($sm);
            $this->albumMapper = $sm->get('Blog\Model\AlbumMapper');
        }
//        echo var_dump($this->albumMapper);
        return $this->albumMapper;
    }

    public function getArtistMapper()
    {
//        var_dump($this->artistMapper);
        if (!$this->artistMapper) {
            $sm = $this->getServiceLocator();
//            echo var_dump($sm);
            $this->artistMapper = $sm->get('Blog\Model\ArtistMapper');
        }
//        echo var_dump($this->artistMapper);
        return $this->artistMapper;
    }

    public function indexAction()
    {
//        $id = 3;
        return new ViewModel(array(
            'albums' => $this->getAlbumMapper()->fetchAll(),
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
        $form = $this->getServiceLocator()->get('Blog\Form\AlbumForm');

        if ($this->getRequest()->isPost()) {
            $form->bind($album = new Album());
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                $artistName = str_replace('  ', ' ', $album->getArtist()->getName());
                $albumTitle = str_replace('  ', ' ', $album->getTitle());
//                $album = $album->setTitle($albumTitle);
                $artist = new Artist();
                $artist = $artist->setName($artistName);
                $IdCountBeforeSave = $this->getArtistMapper()->getColumnCount('id');
//                var_dump($artist);
                $this->getArtistMapper()->saveArtist($artist);
                $IdCountAfterSave = $this->getArtistMapper()->getColumnCount('id');
//                var_dump($IdCountBeforeSave);
//                var_dump($IdCountAfterSave);
                if ($IdCountAfterSave > $IdCountBeforeSave) {
                    $artist_id = $this->getArtistMapper()->lastInsertValue;
                    $album = $album->setArtistId($artist_id);
//                    echo var_dump($artist_id);
                    $this->getAlbumMapper()->saveAlbum($album);
                } else {
                    $artist_id = $this->getArtistMapper()->getArtistIdByName($artistName);
//                    var_dump($artistName);
                    $album = $album->setTitle($albumTitle);
                    $album = $album->setArtistId($artist_id);
////                    var_dump($album);
                    $this->getAlbumMapper()->saveAlbum($album);
                }

                return $this->redirect()->toRoute('blog');
            }
        }
//            echo var_dump($form);
        return array('form' => $form);
//        }
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