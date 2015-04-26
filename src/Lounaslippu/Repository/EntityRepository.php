<?php

namespace Lounaslippu\Repository;

use Tsoha\DB;

class EntityRepository {

    public function save(array $models){
        /** @var BaseModel $model */
        $connection = DB::connection();
        $connection->beginTransaction();
        foreach($models as $model){
            $data = $model->getInsertSql();

            $query = $connection->prepare(key($data));
            if(!$query->execute(current($data))){
                $error = $query->errorInfo();
                return $error[2];
            }
            if(method_exists($model,'setID')){
                $model->setId($connection->lastInsertId());
            }
        }
        $connection->commit();
        return true;
    }
}