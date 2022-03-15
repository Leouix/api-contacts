<?php

require_once ROOT . '/components/DB.php';

class Contacts {

    private static function isContactsTableExist() {
        $db = DB::getConnection();
        $sql = "SHOW TABLES LIKE '%contacts%'";
        $result = $db->query($sql);
        return $result->fetchAll();
    }

    private static function createTableContacts() {
        $db = DB::getConnection();
        $sql = "CREATE TABLE `contacts` (
            `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(30) NOT NULL,
            `phone` VARCHAR(30) NOT NULL,
            `email` VARCHAR(50) NOT NULL,
            `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX (`phone`)
        )";

        $db->exec($sql);
    }

    public static function insertContacts( $option, $values ) {

        $db = DB::getConnection();

        if( !self::isContactsTableExist() ) {
            self::createTableContacts();
        }

        $sql = "INSERT INTO `contacts` ( `source_id`, `name`, `phone`, `email` ) VALUES {$option}";

        $result = [];
        try {
            $stmt= $db->prepare($sql);
            if( $stmt->execute( $values ) ) {
                $result['success'] = $stmt->rowCount();
            } else {
                return $result['error'] = 'Something is wrong';
            }
            return $result;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public static function getRowsByPhone( $phone ) {
        $db = DB::getConnection();
        $sql = "SELECT * FROM `contacts` WHERE `phone` = {$phone}";
        $stmt = $db->query($sql);
        $result['get-rows'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function checkDateToday( $source_id ) {
        $db = DB::getConnection();
        $today = date('Y-m-d');
        $sql = "SELECT `id` FROM `contacts` WHERE `source_id` = $source_id AND `timestamp` LIKE '%$today%' LIMIT 1";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}