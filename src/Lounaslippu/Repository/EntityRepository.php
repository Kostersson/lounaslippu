<?php

namespace Lounaslippu\Repository;

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
        return $this->save($models, true);
    }

    /**
     * @param array $models
     * @param bool $update
     * @return bool
     */
    private function save(array $models, $update = false)
    {
        /** @var BaseModel $model */
        $connection = DB::connection();
        $connection->beginTransaction();
        foreach ($models as $model) {
            if ($update) {
                $data = $model->getUpdateSql();
            } else {
                $data = $model->getInsertSql();
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