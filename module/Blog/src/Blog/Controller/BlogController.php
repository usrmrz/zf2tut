<?php

namespace Blog\Controller;

//use Zend\ServiceManager\ServiceLocatorInterface;
//use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Blog\Model\Album as AlbumEntity;
use Blog\Model\Artist as ArtistEntity;
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
            $this->albumMapper = $sm->get('Blog\Model\AlbumMapper');
        }
        return $this->albumMapper;
    }

    public function getArtistMapper()
    {
        if (!$this->artistMapper) {
            $sm = $this->getServiceLocator();
            $this->artistMapper = $sm->get('Blog\Model\ArtistMapper');
        }
        return $this->artistMapper;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'albums' => $this->getAlbumMapper()->fetchAllByASC(),
        ));
    }

    public function addAction()
    {
        $form = $this->getServiceLocator()->get('Blog\Form\AlbumForm');

        if ($this->getRequest()->isPost()) {
            $form->bind($album = new AlbumEntity());
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                $artistName = $album->getArtist()->getName();
                $albumTitle = $album->getTitle();
                $artist = new ArtistEntity();
                $artist = $artist->setName($artistName);
                $this->getArtistMapper()->saveArtist($artist);
                $artist_id = $this->getArtistMapper()->lastInsertValue;
                if ($artist_id) {
                    $album = $album->setArtistId($artist_id);
                    $this->getAlbumMapper()->saveAlbum($album);
                } else {
                    $artist_id = $this->getArtistMapper()->getArtistIdByName($artistName);
                    $album = $album->setTitle($albumTitle);
                    $album = $album->setArtistId($artist_id);
                    $this->getAlbumMapper()->saveAlbum($album);
                }
                return $this->redirect()->toRoute('blog');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album', array(
                'action' => 'add'
            ));
        }
        $data = $this->getAlbumMapper()->getAlbum($id);
        $album = new AlbumEntity();
        $album->setId($id);
        $album->setTitle($data['title']);
        $album->setArtistId($data['artist_id']);
        $album->getArtist()->setId($data['artist_id']);
        $album->getArtist()->setName($data['name']);
        $form = $this->getServiceLocator()->get('Blog\Form\AlbumForm');
        $form->bind($album);
        if ($this->getRequest()->isPost()) {
            $form->setData($this->request->getPost());
            if ($form->isValid()) {

//                $artist = $album->getArtist();
                $artistName = $album->getArtist()->getName();
                if ($artistName !== $data['name']) {
                    $findName = $this->getArtistMapper()->findArtistByName($artistName);
                    if ($findName) {
                        $album->setArtistId($findName['id']);
                        $findMustDeleted = $this->getAlbumMapper()->findArtistId($data['artist_id']);
//                        var_dump(count($findMustDeleted));
                        if (count($findMustDeleted) <= 1) {
                            $this->getArtistMapper()->deleteEntity('id', $data['artist_id']);
                        }
                    } else {
                        $this->getArtistMapper()->saveArtist($album->getArtist());
                        $artist_id = $this->getArtistMapper()->lastInsertValue;
                        $album->setArtistId($artist_id);
//                        $this->getArtistMapper()->updateArtist($album->getArtist());
                    }
                }
                $title = $album->getTitle();
                $artist_id = $album->getArtistId();
                if ($title !== $data['title'] || $artist_id !== $data['artist_id']) {
                    $this->getAlbumMapper()->updateAlbum($album);
                }
                return $this->redirect()->toRoute('blog');
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public
    function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        if (!$id) {
            return $this->redirect()->toRoute('blog');
        }
        $request = $this->getRequest();

        if ($request->isPost()) {
            $del = $request->getPost()->get('del', 'НЕТ');
            if ($del == 'ДА') {
                $id = (int)$request->getPost()->get('id');
                $artist_id = $this->getAlbumMapper()->getArtistId($id);
                $this->getAlbumMapper()->deleteEntity('id', $id);
                $artist_count = $this->getAlbumMapper()->getArtistCount($artist_id);
                if (!$artist_count) {
                    $this->getArtistMapper()->deleteEntity('id', $artist_id);
                }
            }
            return $this->redirect()->toRoute('blog');
        }
        return array(
            'id' => $id,
            'album' => $this->getAlbumMapper()->getAlbum($id),
        );
    }
}