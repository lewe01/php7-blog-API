<?php namespace Application\Model;

use Application\Controller\App_config;

class Posts
{
    private static $P_DATA = [];

    public static function all()
    {
        return self::$P_DATA;
    }

    public static function add($b_post)
    {
        $b_post->id = count(self::$P_DATA) + 1;
        self::$P_DATA[] = $b_post;
        self::save();
        return $b_post;
    }

    public static function findById(int $id)
    {
        foreach (self::$P_DATA as $b_post) {
            if ($b_post->id === $id) {
                return $b_post;
            }
        }
        return [];
    }

    public static function load()
    {
        $DB_PATH = App_config::get('DB_PATH', __DIR__ . '/../../db.json');
        self::$P_DATA = json_decode(file_get_contents($DB_PATH));
    }

    public static function save()
    {
        $DB_PATH = App_config::get('DB_PATH', __DIR__ . '/../../db.json');
        file_put_contents($DB_PATH, json_encode(self::$P_DATA, JSON_PRETTY_PRINT));
    }
}
