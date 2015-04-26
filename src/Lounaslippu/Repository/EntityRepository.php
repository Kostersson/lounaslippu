<?php

namespace Lounaslippu\Repository;

use Tsoha\DB;

class EntityRepository {

    public function save(array $models){
        /** @var BaseModel $model */
        foreach($models as $model){
            $data = $model->getInsertSql();
            $connection = DB::connection();
            $query = $connection->prepare(key($data));
            if(!$query->execute(current($data))){
                $error = $query->errorInfo();
                return $error[2];
            }
            if(method_exists($model,'setID')){
                $model->setId($connection->lastInsertId());
            }
        }
        return true;
    }
}