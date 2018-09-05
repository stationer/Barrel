<?php
/**
 * Log Config Changes
 * File : /^BCP/models/Config.php
 *
 * PHP version 5.3
 *
 * @category BetterCarPeople
 * @package  BCP
 * @author   Tyler Uebele <tyler.uebele@bettercarpeople.com>
 * @license  Copyright Better Car People, LLC
 * @link     http://bettercarpeople.com
 */

namespace Stationer\Barrel\models;

use Stationer\Graphite\G;
use Stationer\Graphite\data\PassiveRecord;
use Stationer\Graphite\models\Login;
use Stationer\Graphite\data\DataBroker;

/**
 * Config class - for logging config changes
 *
 * @package  Stationer\Barrel
 * @author   Tyler Uebele
 * @license  MIT https://github.com/stationer/Barrel/blob/master/LICENSE
 * @link     https://github.com/stationer/Barrel
 * @see      PassiveRecord.php
 * @property int         $configlog_id
 * @property int         $created_uts
 * @property string      $updated_dts
 * @property int         $login_id
 * @property string      $tableName
 * @property int         $event_uts
 * @property string      $data
 * @property int         $affected_id
 * @property-read string $loginname
 */
class ConfigLog extends PassiveRecord {
    protected static $table = G_DB_TABL.'ConfigLog';
    protected static $pkey = 'configlog_id';
    protected static $query = '';
    protected static $vars = [
        'configlog_id' => ['type' => 'i', 'min' => 1, 'guard' => true],
        'created_uts'  => ['type' => 'ts', 'min' => 0, 'guard' => true],
        'updated_dts'  => ['type' => 'dt', 'def' => NOW, 'guard' => true],
        'login_id'     => ['type' => 'i', 'min' => 1, 'max' => 65535, 'def' => 0],
        'tableName'    => ['type' => 's', 'max' => 255],
        'event_uts'    => ['type' => 'ts', 'def' => NOW,
                            'ddl' => '`event_uts` int(10) unsigned NOT NULL DEFAULT 0'],
        'data'         => ['type' => 'o', 'max' => 65535],
        'affected_id'  => ['type' => 'i', 'min' => 0],
    ];

    protected $loginname = '';

    /**
     * Wrap the parent constructor and set roles if passed
     *
     * @param bool|int|array $a pkey value|set defaults|set values
     * @param bool           $b Set defaults
     *
     * @throws \Exception
     */
    public function __construct($a = null, $b = null) {
        if ('' == static::$query) {
            $keys        = array_keys(static::$vars);
            self::$query = "
SELECT t.`".join('`, t.`', $keys)."`, l.`loginname`
FROM `".self::$table."` t LEFT JOIN `".Login::getTable()."` l ON t.`login_id` = l.`login_id`
";
        }
        if (G::$S->Login) {
            self::$vars['login_id']['def'] = G::$S->Login->login_id;
        }
        if (is_array($a) && isset($a['loginname'])) {
            $this->loginname = $a['loginname'];
        }
        parent::__construct($a, $b);
    }

    /**
     * Logs data into the config database
     *
     * @param string $table the table name
     * @param int    $key   the affected_id
     * @param mixed  $data  the data being saved
     * @return mixed
     * @throws \Exception
     */
    public static function log($table, $key, $data) {
        $C = new static([
            'tableName'   => $table,
            'affected_id' => $key,
            'data'        => $data,
        ],
            true);

        return G::build(DataBroker::class)->save($C);
    }

    /**
     * Returns the last 100 log entries
     *
     * @param string $table the table name
     * @param int    $key   the affected ID
     *
     * @return array
     */
    public static function getLog($table, $key) {
        /** @var DataBroker $DB */
        $DB = G::build(DataBroker::class);

        return $DB->fetch(static::class, ['tableName' => $table, 'affected_id' => $key], [static::$pkey => false], 100);
    }

    /**
     * Sets the login name after load
     *
     * @param array $row the row
     *
     * @return array
     */
    public function onload(array $row = []) {
        if (isset($row['loginname'])) {
            $this->loginname = $row['loginname'];
            unset($row['loginname']);
        }

        return $row;
    }

    /**
     * Returns the login name
     *
     * @return string
     */
    public function loginname() {
        return $this->loginname;
    }
}
