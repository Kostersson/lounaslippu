<?php
namespace Tsoha;

use Lounaslippu\Model\Exception\CannotDeleteException;

abstract class BaseModel
{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null)
    {
        if (!is_array($attributes)) {
            return;
        }
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function errors()
    {
        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();

        foreach ($this->validators as $validator) {
            $errors = array_merge($errors, $this->$validator());
        }

        return $errors;
    }

    /**
     * Should return array("prepared sql :key" => array("key" => "value"))
     * @return array|null
     */
    public abstract function getInsertSql();

    /**
     * Should return array("prepared sql :key" => array("key" => "value"))
     * @return array|null
     */
    public abstract function getUpdateSql();

    /**
     * Should return array("prepared sql :key" => array("key" => "value"))
     * @return array|null
     * @throws CannotDeleteException
     */
    public abstract function getDeleteSql();

}
