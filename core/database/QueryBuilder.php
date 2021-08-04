<?php

namespace proyecto\core\database;

use PDO;
use PDOException;
use proyecto\app\exceptions\NotFoundException;
use proyecto\app\exceptions\QueryException;
use proyecto\core\App;

abstract class QueryBuilder
{
    private $table;
    private $classEntity;

    /**
     * QueryBuilder constructor.
     * @param $connection
     */
    public function __construct($table, $classEntity)
    {
        $this->connection = App::getConnection();
        $this->table = $table;
        $this->classEntity = $classEntity;
    }

    private function executeQuery($sql, $parameters = [])
    {
        $pdoStatement = $this->connection->prepare($sql);
        if ($pdoStatement->execute($parameters) === false) {
            throw new QueryException("No se ha podido ejecutar la consulta");
        }
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
    }

    public function findBy($filters)
    {
        $sql = "SELECT * FROM $this->table " . $this->getFilters($filters);
        return $this->executeQuery($sql, $filters);
    }

    public function findOneBy($filters)
    {
        $result = $this->findBy($filters);
        if (count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function getFilters($filters)
    {
        if (empty($filters)) {
            return '';
        } else {
            $strFilters = [];
            foreach ($filters as $key => $value) {
                $strFilters[] = $key . '=:'.$key;
            }
        }
        return 'WHERE ' . implode(' and ', $strFilters);
    }

    public function findAll()
    {
        $sql = "SELECT * FROM $this->table";

        return $this->executeQuery($sql);

    }

    public function find($id)
    {
        $sql = "SELECT * from $this->table WHERE id=$id";
        $result = $this->executeQuery($sql);

        if (empty($result)) {
            throw new NotFoundException("No se ha encontrado ningun elemento con id $id");
        }
        return $result[0];
    }

    public function save(IEntity $entity)
    {
        try {
            $parameters = $entity->toArray();

            $sql = sprintf('insert into %s (%s) values (%s)',
                $this->table,
                implode(', ', array_keys($parameters)),
                ':' . implode(',:', array_keys($parameters)));
            $statement = $this->connection->prepare($sql);
            $statement->execute($parameters);
        } catch (PDOException $exception) {
            throw new QueryException('Error al insertar en la BD');
        }
    }

    public function executeTransaction(callable $fnExecuteQuerys)
    {
        try {
            $this->connection->beginTransaction();
            $fnExecuteQuerys();
            $this->connection->commit();
        } catch (PDOException $PDOException) {
            $this->connection->rollBack();
            throw new QueryException('No se ha podido realizar la operacion');
        }
    }

    private function getUpdates($parameters)
    {
        $updates = '';
        foreach ($parameters as $key => $value) {
            if ($key !== 'id') {
                if ($updates !== '') {
                    $updates .= ', ';
                }
                $updates .= $key . '=:' . $key;
            }
        }
        return $updates;
    }

    public function update($entity)
    {
        try {
            $parameters = $entity->toArray();
            $sql = sprintf('UPDATE %s SET %s WHERE id=:id',
                $this->table, $this->getUpdates($parameters));
            $statement = $this->connection->prepare($sql);
            $statement->execute($parameters);
        } catch (PDOException $PDOException) {
            throw new QueryException("Error al actualizar");
        }

    }
}