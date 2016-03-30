<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Ticker\Models;

class Ticker extends \Ilch\Model
{
    /**
     * The id of the ticker.
     *
     * @var int
     */
    protected $id;

    /**
     * The title of the ticker.
     *
     * @var string
     */
    protected $title;

    /**
     * The text of the ticker.
     *
     * @var string
     */
    protected $text;

    /**
     * The link of the ticker.
     *
     * @var string
     */
    protected $link;

    /**
     * The dateTime of the ticker.
     *
     * @var \Ilch\Date
     */
    protected $dateTime;

    /**
     * Gets the id of the ticker.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the id of the ticker.
     *
     * @param int $id
     * @return this
     */
    public function setId($id)
    {
        $this->id = (int)$id;

        return $this;
    }

    /**
     * Gets the title of the ticker.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title of the ticker.
     *
     * @param string $title
     * @return this
     */
    public function setTitle($title)
    {
        $this->title = (string)$title;

        return $this;
    }

    /**
     * Gets the text of the ticker.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the text of the ticker.
     *
     * @param string $text
     * @return this
     */
    public function setText($text)
    {
        $this->text = (string)$text;

        return $this;
    }

    /**
     * Gets the link of the ticker.
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Sets the link of the ticker.
     *
     * @param string $link
     * @return this
     */
    public function setLink($link)
    {
        $this->link = (string)$link;

        return $this;
    }

    /**
     * Gets the dateTime of the ticker.
     *
     * @return int
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Sets the $dateTime of the ticker.
     *
     * @param \Ilch\Date $dateTime
     * @return this
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;

        return $this;
    }
}
