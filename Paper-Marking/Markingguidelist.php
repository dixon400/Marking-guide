<?php
require "Paper.php";
class MarkingGuideList{
    public $PaperArray = [];


    public function __construct(){

    }

    //adds or saves marking guide then overrides if it exist
    public function addPaper($paper){
        $paperObj = new Paper($paper);
        $key = array_search($paperObj, $this->PaperArray);

        if(is_numeric($key)){
            $this->updatePaper($key, $paperObj);
        }else{
            array_push($this->PaperArray , $paperObj);
        }


    }

    public function deletePaper($index){
        $index--;
        if(array_key_exists($index, $this->PaperArray)){
            unset($this->PaperArray[$index]);
            $this->PaperArray = array_values($this->PaperArray);
            return true;
        }else{
            return false;
        }
    }


    public function updatePaper($key , $paperObj){
        $this->PaperArray[$key] = $paperObj;
    }


    public function quit()
    {
        echo "\n\e[0;33mBye Bye!\e[0m";
        exit;
    }


}
