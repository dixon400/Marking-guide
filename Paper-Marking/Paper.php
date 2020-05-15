<?php
class Paper
{
    public $subject;
    public $answers = array();
    public $paper;

    public function __construct($paper){
        $this->paper = $paper;
        $this->setPaper();
        unset($this->answers[count($this->answers)-1]);
    }

    public function setPaper(){
        list($subject, $answer) = explode(":", $this->paper);
        $subject = str_replace(array('[',']'), "", $subject);
        $this->subject = $subject;
        $answer= preg_replace("/[\d,]+/" , "",$answer);
        $this->answers = explode(";", $answer);
       
    }

    public function __toString(){
        return $this->subject;
    }

    public function validatePaper($paper){
        if(preg_match("/^\[[\w]+\]:([\d],[A-Z];)+$/", $paper)){
            return true;
        }else{
            return false;
        }
    }
}
