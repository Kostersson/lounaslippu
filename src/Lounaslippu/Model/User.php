<?php

namespace Lounaslippu\Model;


use Tsoha\BaseModel;
use Valitron\Validator;
use Lounaslippu\Model\Exception\CannotDeleteException;

/**
 * Class User
 * @package Lounaslippu\Model
 */
class User extends BaseModel
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var \DateTime
     */
    protected $modified;

    /**
     * @var string
     */
    protected $password;

    /**
     * @param array $attributes
     */
    public function __construct($attributes)
    {
        parent::__construct($attributes);
        $this->addValidators();
    }

    /**
     * set call_user_function
     */
    private function addValidators()
    {
        $this->validators[] = "addUserValidator";
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }


    /**
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * @return array
     */
    protected function addUserValidator()
    {
        $v = new Validator($_POST);
        $v->rule('required', ['name', 'email', 'password', 'password2'])->message('Kaikki kentät ovat pakollisia');
        $v->rule('email', 'email')->message("Sähköposti ei ole oikean mallinen");
        $v->rule('equals', 'password', 'password2')->message("Salasanat eivät täsmää");
        if ($v->validate()) {
            return array();
        } else {
            return $v->errors();
        }
    }

    /**
     * Should return array("prepared sql :key" => array("key" => "value"))
     * @return array|null
     */
    public function getInsertSql()
    {
        $sql = "insert into users (name, email, password) values (:name, :email, :password)";
        return array($sql => array(
            "name" => $this->name, "email" => $this->email, "password" => $this->password
        ));
    }

    /**
     * Should return array("prepared sql :key" => array("key" => "value"))
     * @return array|null
     */
    public function getUpdateSql()
    {
        $sql = "update users set name = :name, email = :email, password = :password where id = :id";
        return array($sql => array(
            "name" => $this->name, "email" => $this->email, "password" => $this->password, "id" => $this->id
        ));
    }

    /**
     * Should return array("prepared sql :key" => array("key" => "value"))
     * @return array|null
     * @throws CannotDeleteException
     */
    public function getDeleteSql()
    {
        throw new CannotDeleteException("Käyttäjää ei voi poistaa");
    }

}