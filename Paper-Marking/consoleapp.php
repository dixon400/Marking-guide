<?php
require "Markingguidelist.php";
require "StudentPaper.php";

class ConsoleApp
{

    public function __construct()
    {
    $markingGuideObj = new MarkingGuideList;
    $studentPaperObj = new StudentPaper($markingGuideObj);

    }

    public function menuFunction()
    {
    echo "\n\e[0;41m     JAMB MARKING GUIDE      \e[0m\n";
    echo "\e[0;32mPress 1: To save marking guide\e[0m\n";
    echo "\e[0;32mPress 2: To List all Marking guide\e[0m\n";
    echo "\e[0;32mPress 3: To delete Marking guide\e[0m\n";
    echo "\e[0;32mPress 4: To Mark student paper\e[0m\n";
    echo "\e[0;31mPress q: Quit\e[0m\n";
    }


    public function run(){
    
        
        while (true)
        {
            $this->menuFunction();
            $input = readline("\e[0;32m Enter input here: \e[0m\n");
        
            switch ($input) {
                case 1: {
                        echo"\e[1;31;40m Enter marking guide using the format [subject]:1,A;2,C;3,B;4,A;5,D; \e[1;32;40m\n";
                        $input = trim(fgets(STDIN));
        
                        if(preg_match("/^\[[\w]+\]:([\d],[A-Z];)+$/", $input)){
                            $markingGuideObj->addPaper($input);
                            echo"\e[1;31;40m Saved Successfully \e[1;32;40m\n";
                        }else{
                            echo"\e[1;31;40m Invalid format for marking guide \e[1;32;40m\n";
        
                        }
                        break;
                    }
                case 2: {
                        if(isset($markingGuideObj->PaperArray)){
                            echo"==============================================\n";
                            foreach($markingGuideObj->PaperArray as $key => $values){
        
                                echo"(".(++$key).")  ".$values->paper."\n";
        
                            }
                            echo"==============================================\n";
                        }else{
                            echo"No available marking guide\n";
        
                        }
        
                        break;
                    }
                case 3: {
        
                        if(isset($markingGuideObj->PaperArray)){
                            echo"==============================================\n";
                            foreach($markingGuideObj->PaperArray as $key => $values){
        
                                echo"(".(++$key).")  ".$values->paper."\n";
        
                            }
                            echo"==============================================\n";
                        }else{
                            echo"No available marking guide\n";
                        }
                        echo "Enter number of Marking guide you wish to delete\n";
                        $input = trim(fgets(STDIN));
                        if(is_numeric($input)){
                            $status = $markingGuideObj->deletePaper($input);
                            if($status){
                                echo"\e[1;31;40m Deleted successfully \e[1;32;40m\n";
                            }else{
                                echo"\e[1;31;40m Invalid Index \e[1;32;40m \n";
                            }
        
                        }else {
                            echo "\e[1;31;40m Invalid input \e[1;32;40m \n";
                        }
        
        
                        break;
                    }
        
                case 4 : {
                        echo"\e[1;31;40m Enter answer paper you wish to mark using the format [subject]:1,A;2,C;3,B;4,A;5,D; \e[1;32;40m \n";
                        $input = trim(fgets(STDIN));
                        if(preg_match("/^\[[\w]+\]:([\d],[A-Z];)+$/", $input)){
                            $studentPaperObj->setPaper($input);
                            $status = $studentPaperObj->markPaper();
                            if(is_array($status)){
                                echo"Your score is : ".$status[0]."/".$status[1]." and your percentage is: ".($status[0]/$status[1]*100)."%\n";
                            }else{
                                echo" \e[1;31;40m Cannot Mark paper \e[1;32;40m \n";
                            }
                        }else{
                            echo"\e[1;31;40m Invalid format for student paper \e[1;32;40m\n";
        
                        }
                        break;
                    }
        
                case 'q': {
                        exit();
                        break;
                    }
                default: {
                        echo "\n\n\e[0;31mNo / Wrong choice entered. Please provide a valid input.\e[0m\n\n";
                    }
            }
        }
    } 
}


