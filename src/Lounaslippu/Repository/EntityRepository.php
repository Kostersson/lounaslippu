<?php

namespace Lounaslippu\Repository;

use Tsoha\BaseModel;
use Tsoha\DB;

/**
 * Class EntityRepository
 * @package Lounaslippu\Repository
 */
class EntityRepository
{

    /**
     * @param array $models
     * @return bool
     */
    public function insert(array $models)
    {
        return $this->save($models);
    }

    /**
     * @param array $models
     * @return bool
     */
    public function update(array $models)
    {
        return $this->save($models, "update");
    }

    /**
     * @param array $models
     * @return bool
     */
    public function delete(array $models)
    {
        return $this->save($models, "delete");
    }

    /**
     * @param array $models
     * @param null $method
     * @return bool
     */
    private function save(array $models, $method = null)
    {

        $connection = DB::connection();
        $connection->beginTransaction();
        /** @var BaseModel $model */
        foreach ($models as $model) {
            switch($method) {
                case "update":
                    $data = $model->getUpdateSql();
                    break;
                case "delete":
                    $data = $model->getDeleteSql();
                    break;
                default:
                    $data = $model->getInsertSql();
                    break;
            }
            $query = $connection->prepare(key($data));
            if (!$query->execute(current($data))) {
                $error = $query->errorInfo();
                return $error[2];
            }
            if (method_exists($model, 'setID')) {
                $model->setId($connection->lastInsertId());
            }
        }
        $connection->commit();
        return true;
    }
}