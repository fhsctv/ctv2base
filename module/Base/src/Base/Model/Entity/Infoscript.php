<?php

namespace Base\Model\Entity;

class Infoscript extends Inserat {

    protected $titel;
    
    
    public function getTitel() {
        return $this->titel;
    }

    public function setTitel($titel) {
        $this->titel = $titel;
        return $this;
    }


}