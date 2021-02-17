<?php
    namespace App\Classes\TemplateClass;

    use Storage;
    use File;
    use App\Classes\WaterMarks\WaterMarks;

    class TemplateOne {
         
        public function getTempOneData($data) {
            //directory name and file name of the generated document
            $docxFilenameAndDirectory = 'docx\template';

            //choosing the template from the template option passed as request from front end
            $tempName = $data[12];
            $tempPath = Storage::disk('templates')->path($tempName.'.docx');

            $docx = new \Phpdocx\Create\CreateDocxFromTemplate($tempPath);
            $wm = new WaterMarks();

            //Replace placeholder variable by the data passed as request from front end
            $fdata = array('dt' => $data[0], 't' =>$data[1], 'v'=>$data[2], 'title'=>$data[3], 'a1'=>$data[4]);
            $docx -> replaceVariableByText($fdata);

            //File attachment process
            $wfA = new \Phpdocx\Elements\WordFragment($docx, 'document');
            $attachment = new \Phpdocx\Elements\WordFragment($docx, 'document');
            $attachment -> addLink('file', array('url' => $data[5], 'u'=>'single'));
            $attach = array();
            $attach[] = $attachment;
            $wfA -> addText($attach);
            $docx -> replaceVariableByWordFragment(array('attach' => $wfA), array('type' => 'inline', 'target'=> 'document'));
            
            //URL attachment process
            $wfB = new \Phpdocx\Elements\WordFragment($docx, 'document');
            $imageAttachment = new \Phpdocx\Elements\WordFragment($docx, 'document');
            $imageAttachment -> addLink('url', array('url' => $data[6], 'u'=>'single'));
            $img = array();
            $img[] = $imageAttachment;
            $wfB -> addText($img);
            $docx -> replaceVariableByWordFragment(array('link' => $wfB), array('type' => 'inline', 'target'=> 'document'));
            
            //Replace placeholder variable by list of items
            $agendaData = array($data[7], $data[8], $data[9]);
            $docx -> replaceListVariable('list', $agendaData);

            //Image Replacement process
            $imageData = array(
                'height' => 2.7,
                'width' => 4.51,
                'target' => 'document',
            );
            $path = 'temp\\'.$data[11];
            $imagePath = public_path($path);
            $docx->replacePlaceholderImage('image', $imagePath, $imageData);

            //Document Generation from template
            $docx->createDocx(public_path($docxFilenameAndDirectory));
            
            $wm -> waterMark();

            File::delete($imagePath);
            
            return "Success";
        }
    }


?>