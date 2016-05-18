<?php

namespace Evercode1\ViewMaker;

trait ConfiguresCrudInput
{
    public $modelName;

    public $fileWritePaths = [];

    public $fileAppendPaths = [];

    public $crudTokens = [];

    private function setCrudTokens()
    {
        // crudTokens is expecting an array

        $model['model'] = $this->modelName;

        if(isset($this->slug)){

            $model['slug'] = $this->slug;
        }


        $tokenBuilder = new CrudTokens($model);

        $this->crudTokens = $tokenBuilder->formatTokens();

    }


    private function setFilePaths()
    {

        $this->fileWritePaths['model'] = base_path() . '/app/' . $this->crudTokens['upperCaseModelName'] . '.php';
        $this->fileWritePaths['controller'] = base_path() . '/app/Http/Controllers/' . $this->crudTokens['controllerName'] . '.php';
        $this->fileWritePaths['apiController'] = base_path() . '/app/Http/Controllers/ApiController.php';
        $this->fileAppendPaths['routes'] = base_path() . '/app/Http/routes.php';
        $this->fileWritePaths['migration'] = base_path() . '/database/migrations/' . date('Y_m_d_His') . '_create_' .$this->crudTokens['tableName'] . '_table'. '.php';
        $this->fileAppendPaths['factory'] = base_path() . '/database/factories/ModelFactory.php';
        $this->fileWritePaths['test'] = base_path() . '/tests/' .  $this->crudTokens['upperCaseModelName'] .  'Test.php';

    }

}