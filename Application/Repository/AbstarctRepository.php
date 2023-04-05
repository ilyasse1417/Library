<?php

namespace Application\Repository;

abstract class AbstarctRepository
{
    protected $db;
    protected $tableName;
    protected $entityName;
    protected $dirty;

    public function __construct()
    {
        if (!isset($this->tableName)) {
            throw new \LogicException(get_class($this) . ' must have a $tableName property');
        }
        if (!isset($this->entityName)) {
            throw new \LogicException(get_class($this) . ' must have a $entityName property');
        }

        // use one db connection
        if (!isset($_SESSION['pdo'])) {
            $config = require_once 'config.local.php';
            $dbConfig = $config['database'];

            try {
                $this->db = new \PDO("mysql:host={$dbConfig['host']};dbname={$dbConfig['name']}", $dbConfig['user'], $dbConfig['password']);
            } catch (\Exception $ex) {
                // TODO reditect to 404
                dd($ex->getMessage());
            }
            $_SESSION['pdo'] = true;
        }
    }

    public function __destruct()
    {
        if (isset($_SESSION['pdo'])) {
            $this->db = null;
            unset($_SESSION['pdo']);
        }
    }

    public function toEntityObject($class, array $array)
    {
        // Notre convention est la suivante
        // Dans la DB champ_name devient champName dans l'entity
        $object = new $class;
        foreach ($array as $key => $value) {
            $parts = explode('_', $key);
            $property = '';
            foreach ($parts as $part) {
                $property .= ucfirst($part);
            }

            $setterFnc = 'set' . $property;
            if (method_exists($class, $setterFnc)) {
                $object->$setterFnc($value);
            }
        }
        //$this->dirty = $object;
        return $object;
    }

    public function findOneBy(array|string $criterias = []): object|null
    {
        $query = "SELECT * FROM $this->tableName WHERE 1";
        // query
        if (is_array($criterias)) {

            foreach ($criterias as $field => $value) {
                $query .= " AND $field = :$field";
            }
            $stmt = $this->db->prepare($query);

            // bindage
            foreach ($criterias as $field => $value) {
                $stmt->bindValue(":$field", $value);
            }
        } else {
            $query .= " " . $criterias;
            $stmt = $this->db->prepare($query);
        }

        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            return $this->toEntityObject($this->entityName, $result);
        }

        return null;
    }

    /**
     * 
     */
    public function findBy(array|string $criterias = []): array
    {
        $query = "SELECT * FROM $this->tableName WHERE 1";

        // query
        if (is_array($criterias)) {

            foreach ($criterias as $field => $value) {
                $query .= " AND $field = :$field";
            }
            $stmt = $this->db->prepare($query);

            // bindage
            foreach ($criterias as $field => $value) {
                $stmt->bindParam(":$field", $value);
            }
        } else {
            $query .= " " . $criterias;
            $stmt = $this->db->prepare($query);
        }

        $stmt->execute();
        $items = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if ($items) {
            $collection = []; // array off objects
            foreach ($items as $item) {
                $collection[] = $this->toEntityObject($this->entityName, $item);
            }

            return $collection;
        }

        return [];
    }
}
