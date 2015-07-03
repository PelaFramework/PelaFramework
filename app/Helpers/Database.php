<?php namespace Helpers;

use PDO;

class Database extends PDO
{
    protected static $instances = array();

    public static function get($group = false)
    {
        $group = !$group ? array (
            'type' => DB_TYPE,
            'host' => DB_HOST,
            'name' => DB_NAME,
            'user' => DB_USER,
            'pass' => DB_PASS
        ) : $group;

        $type = $group['type'];
        $host = $group['host'];
        $name = $group['name'];
        $user = $group['user'];
        $pass = $group['pass'];

        $id = "$type.$host.$name.$user.$pass";

        if (isset(self::$instances[$id])) {
            return self::$instances[$id];
        }

        try {
            $instance = new Database("$type:host=$host;dbname=$name;charset=utf8", $user, $pass);
            $instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            self::$instances[$id] = $instance;

            return $instance;
        } catch (PDOException $e) {
            Logger::newMessage($e);
            Logger::customErrorMsg();
        }
    }

    public function raw($sql)
    {
        $this->query($sql);
    }

    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_OBJ, $class = '')
    {
        $stmt = $this->prepare($sql);
        foreach ($array as $key => $value) {
            if (is_int($value)) {
                $stmt->bindValue("$key", $value, PDO::PARAM_INT);
            } else {
                $stmt->bindValue("$key", $value);
            }
        }

        $stmt->execute();

        if ($fetchMode === PDO::FETCH_CLASS) {
            return $stmt->fetchAll($fetchMode, $class);
        } else {
            return $stmt->fetchAll($fetchMode);
        }
    }

    public function insert($table, $data)
    {
        ksort($data);

        $fieldNames = implode(',', array_keys($data));
        $fieldValues = ':'.implode(', :', array_keys($data));

        $stmt = $this->prepare("INSERT INTO $table ($fieldNames) VALUES ($fieldValues)");

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();
        return $this->lastInsertId();
    }

    public function update($table, $data, $where)
    {
        ksort($data);

        $fieldDetails = null;
        foreach ($data as $key => $value) {
            $fieldDetails .= "$key = :field_$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        $whereDetails = null;
        $i = 0;
        foreach ($where as $key => $value) {
            if ($i == 0) {
                $whereDetails .= "$key = :where_$key";
            } else {
                $whereDetails .= " AND $key = :where_$key";
            }
            $i++;
        }
        $whereDetails = ltrim($whereDetails, ' AND ');

        $stmt = $this->prepare("UPDATE $table SET $fieldDetails WHERE $whereDetails");

        foreach ($data as $key => $value) {
            $stmt->bindValue(":field_$key", $value);
        }

        foreach ($where as $key => $value) {
            $stmt->bindValue(":where_$key", $value);
        }

        $stmt->execute();
        return $stmt->rowCount();
    }

    public function delete($table, $where, $limit = 1)
    {
        ksort($where);

        $whereDetails = null;
        $i = 0;
        foreach ($where as $key => $value) {
            if ($i == 0) {
                $whereDetails .= "$key = :$key";
            } else {
                $whereDetails .= " AND $key = :$key";
            }
            $i++;
        }
        $whereDetails = ltrim($whereDetails, ' AND ');

        if (is_numeric($limit)) {
            $uselimit = "LIMIT $limit";
        }

        $stmt = $this->prepare("DELETE FROM $table WHERE $whereDetails $uselimit");

        foreach ($where as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();
        return $stmt->rowCount();
    }

    public function truncate($table)
    {
        return $this->exec("TRUNCATE TABLE $table");
    }
}
