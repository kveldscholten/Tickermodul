<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Ticker\Config;

class Config extends \Ilch\Config\Install
{
    public $config = array
    (
        'key' => 'ticker',
        'author' => 'Veldscholten, Kevin',
        'icon_small' => 'ticker.png',
        'languages' => array
        (
            'de_DE' => array
            (
                'name' => 'Ticker',
                'description' => 'Hier kann der Ticker der Seite verwaltet werden.',
            ),
            'en_EN' => array
            (
                'name' => 'Ticker',
                'description' => 'Here you can manage ticker from your Site.',
            ),
        )
    );

    public function install()
    {
        $this->db()->queryMulti($this->getInstallSql());

        $databaseConfig = new \Ilch\Config\Database($this->db());
        $databaseConfig->set('ticker_direction', 'up');
        $databaseConfig->set('ticker_speed', '600');
        $databaseConfig->set('ticker_interval', '4000');
        $databaseConfig->set('ticker_box_limit', '2');
    }

    public function uninstall()
    {
        $this->db()->queryMulti("DROP TABLE `[prefix]_ticker`");
        $this->db()->queryMulti("DELETE FROM `[prefix]_config` WHERE `key` = 'ticker_direction'");
        $this->db()->queryMulti("DELETE FROM `[prefix]_config` WHERE `key` = 'ticker_speed'");
        $this->db()->queryMulti("DELETE FROM `[prefix]_config` WHERE `key` = 'ticker_interval'");
        $this->db()->queryMulti("DELETE FROM `[prefix]_config` WHERE `key` = 'ticker_box_limit'");
    }

    public function getInstallSql()
    {
        return 'CREATE TABLE IF NOT EXISTS `[prefix]_ticker` (
                  `id` INT(11) NOT NULL AUTO_INCREMENT,
                  `title` VARCHAR(255) NOT NULL,
                  `text` MEDIUMTEXT NOT NULL,
                  `link` VARCHAR(255) NOT NULL,
                  `dateTime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;';
    }
}
