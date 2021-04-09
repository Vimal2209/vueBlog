<?php
    namespace App\Classes\WaterMarks;

    class WaterMarks {
        //Test Branch
        private $wm;

        public function waterMark(){
            $srcDirAndFile = 'docx\template.docx';
            $destDirAndFile = 'docx\template';

            //Declaring DocxUtilities and CreateDocx
            $wm = new \Phpdocx\Utilities\DocxUtilities();
            $pdf = new \Phpdocx\Create\CreateDocx;

            $wmOptions = array(
                'text'=> 'DRAFT',
                'font'=> 'Calibri',
                'color'=> 'gray',
                'opacity'=> 0.2,
                'scope'=> 'footer',
                'height'=> '300px',
                'width'=> '400px'
            );

            $opt = array('selectedContent' => 'documents');

            $wm->watermarkDocx(public_path($srcDirAndFile), public_path($destDirAndFile), 'text', $wmOptions);

            $pdf->transformDocument(public_path($srcDirAndFile),public_path('docx\agenda.pdf'), 'msword', $opt);
                        
            unlink(public_path($srcDirAndFile));
        }
    }
?>