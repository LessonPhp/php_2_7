<?php

namespace App;

use App\Exceptions\MultiException;
use App\Models\Article;

abstract class Model
{
    public const TABLE = '';
    public $id;

    /**
     * @return \Generator
     */

    // задание 1
    public static function findAll()
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE;
        //$result = $db->query($sql, [], static::class);
        $result = $db->queryEach($sql,
            [],
            static::class
        );

        return $result;
    }

    /**
     * @param $id
     * @return null
     */
    public static function findById($id)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id=:id';
        $result = $db->query($sql,
            [':id' => $id],
            static::class
        );

        return $result ? $result[0] : null;
    }

    /**
     * @param $data
     * @return mixed
     */

    abstract public function check($data);

    // я использовала этот метод в админ-контроллере
    public function fill(array $data)
    {
        $errors = $this->check($data);

        // поменяла местами
        if (!$errors->empty()) {
            throw $errors;
        }

        foreach ($data as $key => $val) {
            $this->$key = $val;
        }

    }


    public function insert()
    {
        $fields = get_object_vars($this);
        $cols = [];
        $data = [];

        foreach ($fields as $name => $value) {
            if ('id' == $name) {
                continue;
            }

            $cols[] = $name;
            $data[':' . $name] = $value;
        }


        $sql = '
        INSERT INTO ' . static::TABLE . '
        (' . implode(', ', $cols) . ')
         VALUES 
         (' . implode(', ', array_keys($data)) . ')
         ';

        $db = new Db();
        $db->execute($sql, $data);
        $this->id = $db->getLastId();
    }

    public function update()
    {
        $fields = get_object_vars($this);
        $cols = [];
        $data = [];

        foreach ($fields as $name => $value) {
            $data[':' . $name] = $value;
            if ('id' == $name) {
                continue;
            }
            $cols[] = $name . '=:' . $name;
        }

        $sql = '
        UPDATE ' . static::TABLE . '
        SET ' . implode(', ', $cols) . '
        WHERE id=:id';


        $db = new Db();
        $db->execute($sql, $data);
    }


    public function save()
    {
        if (!isset($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }
    }


    public function delete()
    {
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE id=:id';
        $db = new Db();
        $db->execute($sql, [':id' => $this->id]);
    }

}