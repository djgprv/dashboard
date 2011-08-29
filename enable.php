<?php

/*
 * Dashboard - Wolf CMS dashboard plugin
 *
 * Copyright (c) 2008-2011 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 */

/* Prevent direct access. */
if (!defined('IN_CMS')) { exit(); }

$pdo = Record::getConnection();
$table = TABLE_PREFIX."dashboard_log";

if (preg_match('/^mysql/', DB_DSN)) {
    /* Schema for MySQL */
    $pdo->exec("CREATE TABLE $table (
        id          INT(11) NOT NULL AUTO_INCREMENT,
        ident       CHAR(16) NOT NULL,
        priority    INT NOT NULL,
        message     VARCHAR(255),
        username    VARCHAR(64),
        created_on  DATETIME DEFAULT NULL,
        PRIMARY KEY (id)
        ) DEFAULT CHARSET=utf8");
}
else {
    /* Otherwise assume SQLite */
    $pdo->exec("CREATE TABLE $table (
        id          INTEGER PRIMARY KEY AUTOINCREMENT,
        ident       CHAR(16) NOT NULL,
        priority    INT NOT NULL,
        message     VARCHAR(255),
        username    VARCHAR(64),
        created_on  DATETIME DEFAULT NULL
        )");
}
