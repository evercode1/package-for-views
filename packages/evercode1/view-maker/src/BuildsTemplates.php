<?php

namespace Evercode1\ViewMaker;

trait BuildsTemplates
{

    private function getTemplate($filename, $type, $masterPage, $modelName)
    {

        $basicBuilder = new BasicTemplates;

        $dtBuilder = new DatatableTemplates;



        switch($type){

            case 'plain' :
                return 'just a stub for ' . $filename;
                break;

            case 'basic' :
                return $basicBuilder->buildBasicTemplate($filename, $masterPage, $modelName);
                break;

            case 'dt' :
                return $dtBuilder->buildDtTemplate($filename, $masterPage, $modelName);
                break;

            default :

                return 'just a stub for ' . $filename;



        }

    }


}