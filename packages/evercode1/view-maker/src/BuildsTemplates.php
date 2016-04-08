<?php

namespace Evercode1\ViewMaker;

trait BuildsTemplates
{

    private function getTemplate($filename, $type, $masterPage, $modelName, $folderName)
    {

        $basicBuilder = new BasicTemplates;

        $dtBuilder = new DatatableTemplates;



        switch($type){

            case 'plain' :
                return 'just a stub for ' . $filename;
                break;

            case 'basic' :
                return $basicBuilder->buildBasicTemplate($filename, $masterPage, $modelName, $folderName);
                break;

            case 'dt' :
                return $dtBuilder->buildDtTemplate($filename, $masterPage, $modelName, $folderName);
                break;

            default :

                return 'just a stub for ' . $filename;



        }

    }


}