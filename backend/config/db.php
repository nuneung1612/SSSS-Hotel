<?php

// 1. Connect to Database
$db = new SQLite3('../database.db');

// 2. Open Database
if (!$db) {
    echo $db->lastErrorMsg();
}
