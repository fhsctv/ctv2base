<?php


namespace Base\Model\Entity;

class TextLine {
    
    /**
     *
     * @var string
     */
    protected $text;
    
    /**
     *
     * @var bool
     */
    protected $isBulletItem = false;
    
    
    
    /**
     * 
     * @param string $text
     */
    public function __construct($text) {
        
        $this->setText($text);
    }
    
    /**
     * 
     * @return string
     */
    public function getText() {
        return $this->text;
    }

    /**
     * 
     * @param string $text
     * @return \Base\Model\Entity\Text
     */
    public function setText($text) {
        
        $textArray = explode('* ', $text, 2);
        
        if(count($textArray) > 1) {
            
            $this->setIsBulletItem(true);
            $this->text = $textArray[1];
            return $this;
        }
        
        $this->text = $textArray[0];
        return $this;
    }

    /**
     * 
     * @return bool
     */
    public function isBulletItem() {
        return $this->isBulletItem;
    }

    /**
     * 
     * @param bool $isBulletItem
     * @return \Base\Model\Entity\Text
     */
    public function setIsBulletItem($isBulletItem) {
        $this->isBulletItem = $isBulletItem;
        return $this;
    }
    
}
