<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Ticker\Controllers\Admin;

use Modules\Ticker\Mappers\Ticker as TickerMapper;
use Modules\Ticker\Models\Ticker as TickerModel;

class Index extends \Ilch\Controller\Admin
{
    public function init()
    {
        $items = array
        (
            array
            (
                'name' => 'manage',
                'active' => false,
                'icon' => 'fa fa-th-list',
                'url' => $this->getLayout()->getUrl(array('controller' => 'index', 'action' => 'index'))
            ),
            array
            (
                'name' => 'add',
                'active' => false,
                'icon' => 'fa fa-plus-circle',
                'url' => $this->getLayout()->getUrl(array('controller' => 'index', 'action' => 'treat'))
            ),
            array
            (
                'name' => 'settings',
                'active' => false,
                'icon' => 'fa fa-cogs',
                'url' => $this->getLayout()->getUrl(array('controller' => 'settings', 'action' => 'index'))
            )
        );  

        if ($this->getRequest()->getControllerName() == 'index' AND $this->getRequest()->getActionName() == 'treat') {
            $items[1]['active'] = true;
        } elseif ($this->getRequest()->getControllerName() == 'settings') {
            $items[2]['active'] = true;
        } else {
            $items[0]['active'] = true;
        }

        $this->getLayout()->addMenu
        (
            'menuTicker',
            $items
        );
    }

    public function indexAction()
    {
        $tickerMapper = new TickerMapper();

        $this->getLayout()->getAdminHmenu()
                ->add($this->getTranslator()->trans('menuTicker'), array('action' => 'index'));

        if ($this->getRequest()->getPost('check_entries')) {
            if ($this->getRequest()->getPost('action') == 'delete') {
                foreach($this->getRequest()->getPost('check_entries') as $id) {
                    $tickerMapper->delete($id);
                }
            }
        }

        $this->getView()->set('ticker', $tickerMapper->getTicker());
    }

    public function treatAction()
    {
        $tickerMapper = new TickerMapper();

        if ($this->getRequest()->getParam('id')) {
            $this->getLayout()->getAdminHmenu()
                    ->add($this->getTranslator()->trans('menuTicker'), array('action' => 'index'))
                    ->add($this->getTranslator()->trans('edit'), array('action' => 'treat'));

            $this->getView()->set('ticker', $tickerMapper->getTickerById($this->getRequest()->getParam('id')));
        } else {
            $this->getLayout()->getAdminHmenu()
                    ->add($this->getTranslator()->trans('menuTicker'), array('controller' => 'index', 'action' => 'index'))
                    ->add($this->getTranslator()->trans('add'), array('action' => 'treat'));
        }

        if ($this->getRequest()->isPost()) {
            $tickerModel = new TickerModel();

            if ($this->getRequest()->getParam('id')) {
                $tickerModel->setId($this->getRequest()->getParam('id'));
            }

            $title = trim($this->getRequest()->getPost('title'));
            $link = trim($this->getRequest()->getPost('link'));
            $text = trim($this->getRequest()->getPost('text'));

            if (empty($title)) {
                $this->addMessage('missingTitle', 'danger');
            } elseif(empty($text)) {
                $this->addMessage('missingText', 'danger');
            } else {
                $tickerModel->setTitle($title);
                $tickerModel->setLink($link);
                $tickerModel->setText($text);
                $tickerMapper->save($tickerModel);

                $this->addMessage('saveSuccess');

                $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function delAction()
    {
        $tickerMapper = new TickerMapper();

        if ($this->getRequest()->isSecure()) {
            $tickerMapper->delete($this->getRequest()->getParam('id'));

            $this->addMessage('deleteSuccess');
        }

        $this->redirect(array('action' => 'index'));
    }
}
