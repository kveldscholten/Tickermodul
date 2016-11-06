<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Ticker\Controllers\Admin;

use Ilch\Validation;

class Settings extends \Ilch\Controller\Admin
{
    public function init()
    {
        $items = [
            [
                'name' => 'manage',
                'active' => false,
                'icon' => 'fa fa-th-list',
                'url' => $this->getLayout()->getUrl(['controller' => 'index', 'action' => 'index'])
            ],
            [
                'name' => 'settings',
                'active' => true,
                'icon' => 'fa fa-cogs',
                'url' => $this->getLayout()->getUrl(['controller' => 'settings', 'action' => 'index'])
            ]
        ];

        $this->getLayout()->addMenu
        (
            'menuTicker',
            $items
        );
    }

    public function indexAction() 
    {
        $this->getLayout()->getAdminHmenu()
                ->add($this->getTranslator()->trans('menuTicker'), ['controller' => 'index', 'action' => 'index'])
                ->add($this->getTranslator()->trans('settings'), ['action' => 'index']);

        if ($this->getRequest()->isPost()) {
            Validation::setCustomFieldAliases([
                'ticker_speed' => 'tickerSpeed',
                'ticker_interval' => 'tickerInterval',
                'ticker_limit' => 'tickerLimit',
                'ticker_box_limit' => 'tickerBoxLimit',
            ]);

            $validation = Validation::create($this->getRequest()->getPost(), [
                'ticker_direction' => 'required',
                'ticker_speed' => 'required|numeric|integer|min:500',
                'ticker_interval' => 'required|numeric|integer|min:1000',
                'ticker_limit' => 'required|numeric|integer|min:1',
                'ticker_box_limit' => 'required|numeric|integer|min:1'
            ]);

            if ($validation->isValid()) {
                $this->getConfig()->set('ticker_direction', $this->getRequest()->getPost('ticker_direction'));
                $this->getConfig()->set('ticker_speed', $this->getRequest()->getPost('ticker_speed'));
                $this->getConfig()->set('ticker_interval', $this->getRequest()->getPost('ticker_interval'));
                $this->getConfig()->set('ticker_limit', $this->getRequest()->getPost('ticker_limit'));
                $this->getConfig()->set('ticker_box_limit', $this->getRequest()->getPost('ticker_box_limit'));

                $this->redirect()
                    ->withMessage('saveSuccess')
                    ->to(['action' => 'index']);
            }

            $this->redirect()
                ->withInput()
                ->withErrors($validation->getErrorBag())
                ->to(['action' => 'index']);
        }

        $this->getView()->set('ticker_direction', $this->getConfig()->get('ticker_direction'));
        $this->getView()->set('ticker_speed', $this->getConfig()->get('ticker_speed'));
        $this->getView()->set('ticker_interval', $this->getConfig()->get('ticker_interval'));
        $this->getView()->set('ticker_limit', $this->getConfig()->get('ticker_limit'));
        $this->getView()->set('ticker_box_limit', $this->getConfig()->get('ticker_box_limit'));
    }
}
