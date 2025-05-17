<?php

namespace app\Core;

use PDO;
use PDOException;

abstract class BaseActiveRecord {
    protected static $pdo;
    protected static $table = ''; // имя таблицы
    public $id;

    public function __construct() {
        if (!self::$pdo) {
            self::connect();
        }
    }

    protected static function connect() {
        try {
            self::$pdo = new PDO("mysql:host=localhost;dbname=database;charset=utf8", "root", "");
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("DB connection failed: " . $e->getMessage());
        }
    }

    public function save() {
        $data = get_object_vars($this);
        unset($data['id']);

        if ($this->id) {
            // Update
            $fields = implode(', ', array_map(fn($k) => "$k = :$k", array_keys($data)));
            $stmt = self::$pdo->prepare("UPDATE " . static::$table . " SET $fields WHERE id = :id");
            $data['id'] = $this->id;
        } else {
            // Insert
            $columns = implode(', ', array_keys($data));
            $placeholders = implode(', ', array_map(fn($k) => ":$k", array_keys($data)));
            $stmt = self::$pdo->prepare("INSERT INTO " . static::$table . " ($columns) VALUES ($placeholders)");
        }

        $stmt->execute($data);

        if (!$this->id) {
            $this->id = self::$pdo->lastInsertId();
        }

        return $this;
    }

    public function delete() {
        if (!$this->id) {
            return false;
        }

        $stmt = self::$pdo->prepare("DELETE FROM " . static::$table . " WHERE id = :id");
        return $stmt->execute(['id' => $this->id]);
    }

    public static function find($id) {
        self::connect();
        $stmt = self::$pdo->prepare("SELECT * FROM " . static::$table . " WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $object = new static();
        foreach ($data as $key => $value) {
            $object->$key = $value;
        }

        return $object;
    }

    public static function findAll() {
        self::connect();
        $stmt = self::$pdo->query("SELECT * FROM " . static::$table);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];

        foreach ($rows as $row) {
            $obj = new static();
            foreach ($row as $key => $value) {
                $obj->$key = $value;
            }
            $objects[] = $obj;
        }

        return $objects;
    }
}
