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

        $basicTemplateBuilder = new BasicTemplates($masterPage, $modelName, $folderName);

        $commonTemplateBuilder = new CommonTemplates($masterPage, $modelName, $folderName);

        switch ($filename) {

            case 'create' :

                return $commonTemplateBuilder->commonCreateTemplate();

            case 'edit' :

                return $commonTemplateBuilder->commonEditTemplate();

            case 'show' :

                return $commonTemplateBuilder->commonShowTemplate();

            case 'index' :

                return $basicTemplateBuilder->basicIndexTemplate();

            default:

                return 'filename not supported';

        }


    }

    public function buildDtTemplate($filename, $masterPage, $modelName, $folderName)
    {

        $dtTemplateBuilder = new DatatableTemplates($masterPage, $modelName, $folderName);

        $commonTemplateBuilder = new CommonTemplates($masterPage, $modelName, $folderName);

        switch ($filename) {

            case 'create' :

                return $commonTemplateBuilder->commonCreateTemplate();

            case 'edit' :

                return $commonTemplateBuilder->commonEditTemplate();

            case 'show' :

                return $commonTemplateBuilder->commonShowTemplate();

            case 'index' :

                return $dtTemplateBuilder->dtIndexTemplate();

            case 'datatable' :

                return $dtTemplateBuilder->dtDatatableTemplate();

            case 'datatable-script' :

                return $dtTemplateBuilder->dtDatatableScriptTemplate();

            default:

                return 'filename not supported';

        }

    }

}