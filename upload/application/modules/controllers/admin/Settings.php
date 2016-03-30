<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Ticker\Controllers\Admin;

class Settings extends \Ilch\Controller\Admin
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
        $this->getLayout()->getAdminHmenu()
                ->add($this->getTranslator()->trans('menuTicker'), array('controller' => 'index', 'action' => 'index'))
                ->add($this->getTranslator()->trans('settings'), array('action' => 'index'));

        if ($this->getRequest()->isPost()) {
            $this->getConfig()->set('ticker_direction', $this->getRequest()->getPost('ticker_direction'));
            $this->getConfig()->set('ticker_speed', $this->getRequest()->getPost('ticker_speed'));
            $this->getConfig()->set('ticker_interval', $this->getRequest()->getPost('ticker_interval'));
            $this->getConfig()->set('ticker_box_limit', $this->getRequest()->getPost('ticker_box_limit'));

            $this->addMessage('saveSuccess');
        }

        $this->getView()->set('ticker_direction', $this->getConfig()->get('ticker_direction'));
        $this->getView()->set('ticker_speed', $this->getConfig()->get('ticker_speed'));
        $this->getView()->set('ticker_interval', $this->getConfig()->get('ticker_interval'));
        $this->getView()->set('ticker_box_limit', $this->getConfig()->get('ticker_box_limit'));
    }
}
