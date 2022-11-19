<?php

    final class DB {

        private static $instance;

        private function __construct()
        {
            include_once('config/db_config.php');
            $connection = mysqli_connect($db['host'], $db['user'], $db['password'],
                $db['db_name']);
            mysqli_set_charset($connection, $db['charset']);
            self::$instance = $connection;
        }

        public static function getConnection()
        {
            if (!self::$instance) {
                new self();
            }
            return self::$instance;
        }

        private function __clone()
        {

        }

        public function __sleep()
        {

        }

        public function __wakeup()
        {

        }

    }