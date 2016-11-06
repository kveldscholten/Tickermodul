<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Ticker\Controllers\Admin;

use Modules\Ticker\Mappers\Ticker as TickerMapper;
use Modules\Ticker\Models\Ticker as TickerModel;
use Ilch\Validation;

class Index extends \Ilch\Controller\Admin
{
    public function init()
    {
        $items = [
            [
                'name' => 'manage',
                'active' => false,
                'icon' => 'fa fa-th-list',
                'url' => $this->getLayout()->getUrl(['controller' => 'index', 'action' => 'index']),
                [
                    'name' => 'add',
                    'active' => false,
                    'icon' => 'fa fa-plus-circle',
                    'url' => $this->getLayout()->getUrl(['controller' => 'index', 'action' => 'treat'])
                ]
            ],
            [
                'name' => 'settings',
                'active' => false,
                'icon' => 'fa fa-cogs',
                'url' => $this->getLayout()->getUrl(['controller' => 'settings', 'action' => 'index'])
            ]
        ];

        if ($this->getRequest()->getActionName() == 'treat') {
            $items[0][0]['active'] = true;
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
                ->add($this->getTranslator()->trans('menuTicker'), ['action' => 'index']);

        if ($this->getRequest()->getPost('check_entries')) {
            if ($this->getRequest()->getPost('action') == 'delete') {
                foreach ($this->getRequest()->getPost('check_entries') as $id) {
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
                    ->add($this->getTranslator()->trans('menuTicker'), ['action' => 'index'])
                    ->add($this->getTranslator()->trans('edit'), ['action' => 'treat']);

            $this->getView()->set('ticker', $tickerMapper->getTickerById($this->getRequest()->getParam('id')));
        } else {
            $this->getLayout()->getAdminHmenu()
                    ->add($this->getTranslator()->trans('menuTicker'), ['controller' => 'index', 'action' => 'index'])
                    ->add($this->getTranslator()->trans('add'), ['action' => 'treat']);
        }

        if ($this->getRequest()->isPost()) {
            $validation = Validation::create($this->getRequest()->getPost(), [
                'title' => 'required',
                'link' => 'url',
                'text' => 'required'
            ]);

            if ($validation->isValid()) {
                $model = new TickerModel();
                if ($this->getRequest()->getParam('id')) {
                    $model->setId($this->getRequest()->getParam('id'));
                }
                $model->setTitle($this->getRequest()->getPost('title'))
                    ->setLink($this->getRequest()->getPost('link'))
                    ->setText($this->getRequest()->getPost('text'));
                $tickerMapper->save($model);

                $this->redirect()
                    ->withMessage('saveSuccess')
                    ->to(['action' => 'index']);
            }

            $this->redirect()
                ->withInput()
                ->withErrors($validation->getErrorBag())
                ->to(['action' => 'treat']);
        }
    }

    public function delAction()
    {
        $tickerMapper = new TickerMapper();

        if ($this->getRequest()->isSecure()) {
            $tickerMapper->delete($this->getRequest()->getParam('id'));

            $this->addMessage('deleteSuccess');
        }

        $this->redirect(['action' => 'index']);
    }
}
