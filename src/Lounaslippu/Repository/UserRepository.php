<?php
/**
 * Created by IntelliJ IDEA.
 * User: kostersson
 * Date: 10.4.2015
 * Time: 0:51
 */

namespace Lounaslippu\Repository;

use Tsoha\BaseModel;
use Tsoha\DB;

class UserRepository {

    public function save(array $models){
        /** @var BaseModel $model */
        foreach($models as $model){
            $data = $model->getInsertSql();
            $query = DB::connection()->prepare(key($data));
            if(!$query->execute(current($data))){
                $error = $query->errorInfo();
                return $error[2];
            }
        }
        return true;
    }
}