<?php namespace App\Model;

use App\Lib\Config;

class Posts
{
    private static $DATA = [];

    public static function all()
    {
        return self::$DATA;
    }

    public static function add($post)
    {
        $post->id = count(self::$DATA) + 1;
        self::$DATA[] = $post;
        self::save();
        return $post;
    }

    public static function findById(int $id)
    {
        foreach (self::$DATA as $post) {
            if ($post->id === $id) {
                return $post;
            }
        }
        return [];
    }

    public static function load()
    {
        $DB_PATH = Config::get('DB_PATH', __DIR__ . '/../../db.json');
        self::$DATA = json_decode(file_get_contents($DB_PATH));
    }

    public static function save()
    {
        $DB_PATH = Config::get('DB_PATH', __DIR__ . '/../../db.json');
        file_put_contents($DB_PATH, json_encode(self::$DATA, JSON_PRETTY_PRINT));
    }
}
