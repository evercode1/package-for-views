<?php

namespace Evercode1\ViewMaker;

class CrudTokens
{
    public $model;


    public function __construct($modelName)
    {

        $this->model = $modelName;

    }

    public function formatTokens()
    {

        // need upcase model name
        $upperCaseModelName = $this->formatModelName($this->model);

        // need snakecase model name, lowercase

        $field_name = snake_case($this->model) . '_name';

        // need model path, and also account for compound words

        $modelPath = $this->formatModelPath($this->model);

        $modelInstance = $this->formatInstanceName($this->model);

        $tableName = $this->formatTableName($this->model);

        // need to account for compound model names
        $migrationModel = $this->formatMigrationModel($this->model);

        $modelId = $this->formatInstanceName($this->model) . '->id';

        $modelAttribute = $this->formatInstanceName($this->model) . '->' . $field_name;

        $useModel = 'use App\\' . $upperCaseModelName;

        $apiRoute = 'api/' . $modelPath;

        $vueApiRoute = 'api/' . $modelPath . '-vue';

        $apiControllerMethod = $this->formatApiControllerMethod($this->model);

        $vueApiControllerMethod = $this->formatVueApiControllerMethod($this->model);

        $modelResults = $this->formatModelResults($this->model);

        $controllerName = $this->formatModelName($this->model) . 'Controller';

        //create token array using compact

        $tokens = compact('upperCaseModelName',
                          'field_name',
                          'modelPath',
                          'modelInstance',
                          'tableName',
                          'migrationModel',
                          'modelId',
                          'modelAttribute',
                          'useModel',
                          'apiRoute',
                          'vueApiRoute',
                          'apiControllerMethod',
                          'vueApiControllerMethod',
                          'modelResults',
                          'controllerName');




        return $tokens;
    }



    /**
     * @param $content
     * @param $tokens
     * finds a string in content that starts and ends with :::
     * and replaces with variable value
     * @return mixed
     */
    public function insertTokensIntoContent($content)
    {
        $tokens = $this->formatTokens();

        foreach ($tokens as $string => $variable) {

            $content = str_replace(':::' . $string . ':::', $variable, $content);
        }

        return $content;
    }

    private function formatModelName($model)
    {
        return $model = ucwords($model);

    }

    private function formatModelPath($model)
    {
        $model = preg_split('/(?=[A-Z])/',$model);

        $model = implode('-', $model);

        $model = ltrim($model, '-');

        return $model = strtolower($model);

    }

    private function formatTableName($model)
    {

        $model = $this->formatModelName($model);

        $model = snake_case($model);

        $model = strtolower($model);

        return $model = str_plural($model);


    }

    private function formatInstanceName($model)
    {

        return $model = camel_case($model);


    }

    private function formatModelResults($model)
    {

        $model = $this->formatInstanceName($model);

        return $model = str_plural($model);
    }

    private function formatMigrationModel($model)
    {
        $model = $this->formatModelName($model);

        return $model = str_plural($model);

    }

    private function formatApiControllerMethod($model)
    {
         $modelMethod = $this->formatInstanceName($model);

        return $modelMethod . 'Data';

    }

    private function formatVueApiControllerMethod($model)
    {
        $modelMethod = $this->formatInstanceName($model);

        return $modelMethod . 'VueData';

    }


}
