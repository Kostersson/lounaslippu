<?php

namespace Lounaslippu\Model;


use Tsoha\BaseModel;
use Valitron\Validator;

class UserModel extends BaseModel {

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

    public function __construct($attributes){
        parent::__construct($attributes);
        $this->addValidators();
    }

    private function addValidators(){
        $this->validators[] = "addUserValidator";
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
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param \DateTime $modified
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    }

    protected function addUserValidator()
    {
        $v = new Validator($_POST);
        $v->rule('required', ['name', 'email', 'password1', 'password2'])->message('Kaikki kentät ovat pakollisia');
        $v->rule('email', 'email')->message("Sähköposti ei ole oikena mallinen");
        $v->rule('equals', ['password1', 'password2'])->message("Salasanat eivät täsmää");
        if($v->validate()) {
            return array();
        } else {
           return $v->errors();
        }
    }

}