<?php

namespace Evercode1\ViewMaker;

trait BuildsCrudTemplates
{

    private $crudTemplate;

    private function getContentFromTemplate($fileName,  array $tokens, $fileExists=false)
    {


        switch($fileName){

            case 'model' :
                return $this->buildModelTemplate($tokens);
                break;

            case 'controller' :
                return $this->buildControllerTemplate($tokens);
                break;

            case 'apiController' :

                if ($fileExists){

                    return $this->buildAppendApiControllerTemplate($tokens);
                    break;
                }
                return $this->buildApiControllerTemplate($tokens);
                break;

            case 'migration' :

                return $this->buildMigrationTemplate($tokens);
                break;

            case 'routes' :
                return $this->buildRouteTemplate($tokens);
                break;

            case 'factory' :
                return $this->buildFactoryTemplate($tokens);
                break;

            case 'test' :
                return $this->buildTestTemplate($tokens);
                break;


            default :

                return 'Something went wrong';



        }

    }

    private function buildModelTemplate($tokens)
    {
      $this->setTemplateInstance($tokens);

        return $this->crudTemplate->modelTemplate();

    }

    private function buildControllerTemplate($tokens)
    {
        $this->setTemplateInstance($tokens);

        return $this->crudTemplate->controllerTemplate();

    }

    private function buildApiControllerTemplate($tokens)
    {

        $this->setTemplateInstance($tokens);

        return $this->crudTemplate->apiControllerTemplate();

    }

    private function buildAppendApiControllerTemplate($tokens)
    {
        $this->setTemplateInstance($tokens);

        return $this->crudTemplate->appendApiControllerTemplate();


    }

    private function buildMigrationTemplate($tokens)
    {

        $this->setTemplateInstance($tokens);

        return $this->crudTemplate->migrationTemplate();


    }

    private function buildRouteTemplate($tokens)
    {
        $this->setTemplateInstance($tokens);

        return $this->crudTemplate->routeTemplate();
    }

    private function buildFactoryTemplate($tokens)
    {
        $this->setTemplateInstance($tokens);

        return $this->crudTemplate->factoryTemplate();
    }

    private function buildTestTemplate($tokens)
    {
        $this->setTemplateInstance($tokens);

        return $this->crudTemplate->testTemplate();
    }

    private function setTemplateInstance($tokens)
    {
        $this->crudTemplate = new CrudTemplates($tokens['upperCaseModelName']);

    }


}