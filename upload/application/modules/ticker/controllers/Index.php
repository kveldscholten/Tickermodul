<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Ticker\Controllers;

use Modules\Ticker\Mappers\Ticker as TickerMapper;

class Index extends \Ilch\Controller\Frontend
{
    public function indexAction()
    {
        $tickerMapper = new TickerMapper();

        $this->getLayout()->getHmenu()
                ->add($this->getTranslator()->trans('menuTicker'), ['action' => 'index']);

        $this->getView()->set('ticker', $tickerMapper->getTicker());
    }
}
