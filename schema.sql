--
-- Current Schema CREATE statements go here
-- 

 -- \Stationer\Barrel\models\ConfigLog
DROP TABLE IF EXISTS `ConfigLog`;
CREATE TABLE IF NOT EXISTS `ConfigLog` (
    `configlog_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `created_uts` int(10) unsigned NOT NULL DEFAULT 0,
    `updated_dts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `login_id` smallint(5) unsigned NOT NULL DEFAULT 0,
    `tableName` varchar(255) NOT NULL,
    `event_uts` int(10) unsigned NOT NULL DEFAULT 0,
    `data` text NOT NULL,
    `affected_id` int(10) unsigned NOT NULL DEFAULT 0,
    KEY (`updated_dts`),
    PRIMARY KEY(`configlog_id`)
);


 -- \Stationer\Barrel\models\Email
DROP TABLE IF EXISTS `Email`;
CREATE TABLE IF NOT EXISTS `Email` (
    `email_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `created_uts` int(10) unsigned NOT NULL DEFAULT 0,
    `updated_dts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `headerRaw` text NOT NULL,
    `bodyRaw` text NOT NULL,
    `to` text NOT NULL,
    `from` text NOT NULL,
    `subject` text NOT NULL,
    `date_uts` int(11) NOT NULL DEFAULT 0,
    `messageId` varchar(155) NOT NULL,
    KEY (`updated_dts`),
    PRIMARY KEY(`email_id`)
);
