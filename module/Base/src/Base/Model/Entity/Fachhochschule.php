<?php

namespace Base\Model\Entity;

class Fachhochschule extends User {
    
    /**
     * Name der Fachhochschul- Organisation (Stura, Club, ...)
     * @var string
     */
    protected $name;
    
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        
        assert(is_string($name));
        
        $this->name = $name;
        return $this;
    }


}
