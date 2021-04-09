<?php

    namespace App\Classes;
    
    use App\Classes\TemplateClass\TemplateOne;
    use App\Classes\TemplateClass\TemplateTwo;
    use App\Classes\TemplateClass\TemplateThree;
    use App\Classes\TemplateClass\TemplateFour;

    class IdentifyTemplateClass {

        //Check 
        private $templateName, $temp;

        //Identify template name and call it's appropriate class
        public function identifyTemplate($data){
            $templateName = $data[12];
            switch($templateName) {
                case 'T1': 
                    $temp = new TemplateOne();
                    $res = $temp -> getTempOneData($data);
                    return $res;
                    break;
                
                case 'T2':
                    $temp = new TemplateTwo();
                    $res = $temp -> getTempTwoData($data);
                    return $res;
                    break;
                
                case 'T3':
                    $temp = new TemplateThree();
                    $res = $temp -> getTempThreeData($data);
                    return $res;
                    break;

                case 'T4':
                    $temp = new TemplateFour();
                    $res = $temp -> getTempFourData($data);
                    return $res;
                    break;
                    
            }
           
        }

    }
?>