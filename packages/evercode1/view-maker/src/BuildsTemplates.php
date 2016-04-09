<?php

namespace Evercode1\ViewMaker;

trait BuildsTemplates
{

    private function getTemplate($filename, $templateType, $masterPage, $modelName, $folderName)
    {


        switch($templateType){

            case 'plain' :
                return 'just a stub for ' . $filename;
                break;

            case 'basic' :
                return $this->buildBasicTemplate($filename, $masterPage, $modelName, $folderName);
                break;

            case 'dt' :
                return $this->buildDtTemplate($filename, $masterPage, $modelName, $folderName);
                break;

            default :

                return 'just a stub for ' . $filename;



        }

    }

    public function buildBasicTemplate($filename, $masterPage, $modelName, $folderName)
    {

        $basicTemplateBuilder = new BasicTemplates;

        $commonTemplateBuilder = new CommonTemplates;

        switch ($filename) {

            case 'create' :

                return $commonTemplateBuilder->commonCreateTemplate($masterPage, $modelName, $folderName);

            case 'edit' :

                return $commonTemplateBuilder->commonEditTemplate($masterPage, $modelName, $folderName);

            case 'show' :

                return $commonTemplateBuilder->commonShowTemplate($masterPage, $modelName, $folderName);

            case 'index' :

                return $basicTemplateBuilder->basicIndexTemplate($masterPage, $modelName, $folderName);

            default:

                return 'filename not supported';

        }


    }

    public function buildDtTemplate($filename, $masterPage, $modelName, $folderName)
    {

        $dtTemplateBuilder = new DatatableTemplates;

        $commonTemplateBuilder = new CommonTemplates;

        switch ($filename) {

            case 'create' :

                return $commonTemplateBuilder->commonCreateTemplate($masterPage, $modelName, $folderName);

            case 'edit' :

                return $commonTemplateBuilder->commonEditTemplate($masterPage, $modelName, $folderName);

            case 'show' :

                return $commonTemplateBuilder->commonShowTemplate($masterPage, $modelName, $folderName);

            case 'index' :

                return $dtTemplateBuilder->dtIndexTemplate($masterPage, $modelName , $folderName);

            case 'datatable' :

                return $dtTemplateBuilder->dtDatatableTemplate($modelName, $folderName);

            case 'datatable-script' :

                return $dtTemplateBuilder->dtDatatableScriptTemplate($modelName, $folderName);

            default:

                return 'filename not supported';

        }

    }

}