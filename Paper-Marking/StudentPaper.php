<?php


class StudentPaper{
    public $studentPaper;
    public $markingGuideObj;

    public function __construct(MarkingGuideList $markingGuideObj){
        $this->markingGuideObj = $markingGuideObj;
    }

    public function setPaper($paper){
        $this->studentPaper = new Paper($paper);
        

    }

    //Marks Student Paper using marking guide and returns an array of the result

    public function markPaper(){
        $key = array_search($this->studentPaper->subject, $this->markingGuideObj->PaperArray);
        
        if(is_numeric($key)){
            $result = 0;
            for($i=0 ; $i < count($this->studentPaper->answers); $i++){
                if($this->studentPaper->answers[$i] == $this->markingGuideObj->PaperArray[$key]->answers[$i]){
                    $result++;
                }
            }
            $output = array($result,count(($this->markingGuideObj->PaperArray[$key]->answers)));
            return $output;
        }else{
            return false;
        }



    }


}