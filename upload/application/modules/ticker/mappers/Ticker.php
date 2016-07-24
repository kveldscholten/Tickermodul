<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Ticker\Mappers;

use Modules\Ticker\Models\Ticker as TickerModel;

class Ticker extends \Ilch\Mapper
{
    /**
     * Gets the Ticker entries.
     *
     * @param $limit
     * @return TickerModel[]|array
     */
    public function getTicker($limit = null)
    {
        if ($limit != null) {
            $entryArray = $this->db()->select('*')
                ->from('ticker')
                ->order(['id' => 'DESC'])
                ->limit($limit)
                ->execute()
                ->fetchRows();            
        } else {
            $entryArray = $this->db()->select('*')
                ->from('ticker')
                ->order(['id' => 'DESC'])
                ->execute()
                ->fetchRows();
        }

        if (empty($entryArray)) {
            return null;
        }

        $entry = [];
        foreach ($entryArray as $entries) {
            $entryModel = new TickerModel();
            $entryModel->setId($entries['id']);
            $entryModel->setTitle($entries['title']);
            $entryModel->setText($entries['text']);
            $entryModel->setLink($entries['link']);
            $entryModel->setDateTime($entries['dateTime']);
            $entry[] = $entryModel;
        }

        return $entry;
    }

    /**
     * Gets ticker.
     *
     * @param integer $id
     * @return TickerModel|null
     */
    public function getTickerById($id)
    {
        $entryRow = $this->db()->select('*')
            ->from('ticker')
            ->where(['id' => $id])
            ->execute()
            ->fetchAssoc();

        if (empty($entryRow)) {
            return null;
        }

        $entryModel = new TickerModel();
        $entryModel->setId($entryRow['id']);
        $entryModel->setTitle($entryRow['title']);
        $entryModel->setLink($entryRow['link']);
        $entryModel->setText($entryRow['text']);

        return $entryModel;
    }

    /**
     * Inserts or updates ticker model.
     *
     * @param TickerModel $ticker
     */
    public function save(TickerModel $ticker)
    {
        $fields = array
        (
            'title' => $ticker->getTitle(),
            'link' => $ticker->getLink(),
            'text' => $ticker->getText(),
        );

        if ($ticker->getId()) {
            $this->db()->update('ticker')
                ->values($fields)
                ->where(['id' => $ticker->getId()])
                ->execute();
        } else {
            $this->db()->insert('ticker')
                ->values($fields)
                ->execute();
        }
    }

    /**
     * Deletes ticker with given id.
     *
     * @param integer $id
     */
    public function delete($id)
    {
        $this->db()->delete('ticker')
            ->where(['id' => $id])
            ->execute();
    }
}
