<?php

// Posts,Usersの管理者、一般の区別

define("USERS__ROLE__SUDO", 1); //全権限有り
define("USERS__ROLE__USER", 2); //一部の機能のみ利用可

// Contentの対応ステータス

define("CONTACTS__FLAG__NOT_YET", 1); //未対応
define("CONTACTS__FLAG__DONE", 2); //対応済