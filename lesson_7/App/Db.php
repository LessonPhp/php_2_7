<?php

namespace App;


class Db
{
    protected $dbh;

    public function __construct()
    {
        $config = new \App\Config();
        try {
            $this->dbh = new \PDO(
                'mysql:host=' . $config->data['db']['host'] . ';dbname=' . $config->data['db']['dbname'],
                $config->data['db']['user'],
                $config->data['db']['password']);
        } catch (\PDOException $ex) {
            throw new \App\Exceptions\DbException('Нет соединения с базой данных');
        }
    }

    public function query($sql, $data = [], $class)
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($data);
        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    /**
     * @param $sql
     * @param array $data
     * @param $class
     * @return \Generator
     */
    // задание 1
    public function queryEach($sql, $data = [], $class)
    {
        $sth = $this->dbh->prepare($sql);
        $sth->setFetchMode(\PDO::FETCH_CLASS, $class);
        if ($sth->execute($data)) {
            // исправила
            while (false !== $res = $sth->fetch()) {
                yield $res;
            }
        }
    }

    // исправила
    public function execute($query, $params = [])
    {
        $sth = $this->dbh->prepare($query);
        if (true === $sth->execute($params)) {
            return true;
        } else {
            throw new \App\Exceptions\DbException('Ошибка в запросе');
        }
    }


    public function getLastId()
    {
        return $this->dbh->lastInsertId();
    }
}