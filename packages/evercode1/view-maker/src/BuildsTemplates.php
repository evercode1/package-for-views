<?php

namespace Evercode1\ViewMaker;

trait BuildsTemplates
{

    private function getTemplate($fileName, $templateType, array $tokens)
    {


        switch($templateType){

            case 'plain' :
                return 'just a stub for ' . $fileName;
                break;

            case 'basic' :
                return $this->buildBasicTemplate($fileName, $tokens);
                break;

            case 'dt' :
                return $this->buildDtTemplate($fileName, $tokens);
                break;

            default :

                return 'just a stub for ' . $fileName;



        }

    }

    public function buildBasicTemplate($fileName, array $tokens)
    {

        $basicTemplateBuilder = new BasicTemplates($tokens);

        $commonTemplateBuilder = new CommonTemplates($tokens);

        switch ($fileName) {

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

    public function buildDtTemplate($fileName, array $tokens)
    {

        $dtTemplateBuilder = new DatatableTemplates($tokens);

        $commonTemplateBuilder = new CommonTemplates($tokens);

        switch ($fileName) {

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