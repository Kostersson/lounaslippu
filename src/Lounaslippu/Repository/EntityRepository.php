<?php

namespace Lounaslippu\Repository;

use Tsoha\DB;

class EntityRepository {

    public function insert(array $models){
       return $this->save($models);
    }
    public function update(array $models){
        return $this->save($models, true);
    }

    private function save(array $models, $update = false){
        /** @var BaseModel $model */
        $connection = DB::connection();
        $connection->beginTransaction();
        foreach($models as $model){
            if($update){
                $data = $model->getUpdateSql();
            }
            else {
                $data = $model->getInsertSql();
            }
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