<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Ticker\Boxes;

use Modules\Ticker\Mappers\Ticker as TickerMapper;

class Ticker extends \Ilch\Box
{
    public function render()
    {
        $tickerMapper = new TickerMapper();

        $this->getView()->set('ticker', $tickerMapper->getTicker($this->getConfig()->get('ticker_limit')));
        $this->getView()->set('tickerDirection', $this->getConfig()->get('ticker_direction'));
        $this->getView()->set('tickerSpeed', $this->getConfig()->get('ticker_speed'));
        $this->getView()->set('tickerInterval', $this->getConfig()->get('ticker_interval'));
        $this->getView()->set('tickerLimit', $this->getConfig()->get('ticker_box_limit'));
    }
}
