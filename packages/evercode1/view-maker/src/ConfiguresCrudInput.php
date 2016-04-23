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
        $tokenBuilder = new CrudTokens($this->modelName);

        $this->crudTokens = $tokenBuilder->formatTokens();

    }

    private function setFilePaths()
    {

        $this->fileWritePaths['model'] = base_path() . '/App/' . $this->crudTokens['upperCaseModelName'] . '.php';
        $this->fileWritePaths['controller'] = base_path() . '/App/Http/Controllers/' . $this->crudTokens['controllerName'] . '.php';
        $this->fileWritePaths['apiController'] = base_path() . '/App/Http/Controllers/ApiController.php';
        $this->fileAppendPaths['routes'] = base_path() . '/App/Http/routes.php';
        $this->fileWritePaths['migration'] = base_path() . '/database/migrations/' . date('Y_m_d_His') . '_create_' .$this->crudTokens['tableName'] . '_table'. '.php';
        $this->fileAppendPaths['factory'] = base_path() . '/database/factories/ModelFactory.php';
        $this->fileWritePaths['test'] = base_path() . '/tests/' .  $this->crudTokens['upperCaseModelName'] .  'Test.php';

    }

}