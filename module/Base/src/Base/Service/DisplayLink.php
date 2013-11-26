<?php

namespace Base\Service;

use \Base\Model\Table\InseratBildschirmLinker as Table;

class DisplayLink {
    
    /**
     * @var \Base\Model\Table\InseratBildschirmLinker
     */
    protected $table;
    
    /**
     * @return \Base\Model\Table\InseratBildschirmLinker
     */
    public function getTable() {
        
        return $this->table;
    }

    /*
     * @param \Base\Model\Table\InseratBildschirmLinker $table
     * @return \Base\Service\DisplayLink
     */
    public function setTable(Table $table) {
        
        $this->table = $table;
        return $this;
    }

    
    /**
     * @param int $inseratId
     * @param int $bildschirmId
     */
    public function add($inseratId, $bildschirmId) {
        
        $this->_checkArguments($inseratId, $bildschirmId);
        
        return $this->getTable()->insert(
            [
                'inserat_id'    => $inseratId, 
                'bildschirm_id' => $bildschirmId
            ]
        );
        
    }
    
    /**
     * @param type $inseratId
     * @param type $bildschirmId
     */
    public function delete($inseratId, $bildschirmId) {
        
        $this->_checkArguments($inseratId, $bildschirmId);
        
        return $this->getTable()->delete($inseratId, $bildschirmId);
    }
    
    
    /**
     * Wächter- Methode zum Prüfen der Richtigkeit der Parameter
     * @param int $inseratId
     * @param int $bildschirmId
     * @throws \InvalidArgumentException
     */
    protected  function _checkArguments($inseratId, $bildschirmId) {
        
        if(!($inseratId && $bildschirmId)) {
            throw new \InvalidArgumentException('Die Werte für Inserat- Id und/oder Bildschirm- Id sind ungültig!');
        }
        
        if(!(is_numeric($inseratId) && is_numeric($bildschirmId))){
            throw new \InvalidArgumentException('Bitte geben Sie für Inserat- Id und Bildschirm- Id Zahlen an!');
        }
    }

    
}

