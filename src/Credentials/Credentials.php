<?php

namespace Credentials;

class Credentials
{
    private static $credentialsFile = __DIR__ . '/../../data/my.credentials';
    private static $credentials = [];

    private static function loadFile() {
        $lines = file(self::$credentialsFile, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line) {
            $v = trim($line);
            if ($v == '') continue;

            list($entry, $authValues) = explode(',', $v);
            self::$credentials[$entry] = trim($authValues);
        }
        return self::$credentials;
    }

    public static function getAuth($entry='') {
        self::$credentials = self::loadFile();
        return self::$credentials[$entry];
    }

    public static function getUsername($entry='') {
        return explode(':', self::getAuth($entry))[0];
    }

    public static function getPassword($entry='') {
        return explode(':', self::getAuth($entry))[1];
    }
}
