<?php

namespace Evercode1\ViewMaker;

class FormatsTokens
{
    public $modelName;
    public $folderName;
    public $masterPage;

    public function __construct(array $tokens)
    {

        $this->setTokens($tokens);

    }

    public function formatTokens($content)
    {
        $upperCaseModelName = ucfirst($this->modelName);
        $field_name = snake_case($this->modelName) . '_name';
        $modelId = $this->modelName . '->id';
        $modelAttribute = $this->modelName . '->' . $field_name;
        $createdAt = $this->modelName . '->created_at';
        $modelRoute = '/' . $this->folderName;
        $tableName = $this->modelName . '_table';
        $masterPage = $this->masterPage;
        $modelName = $this->modelName;
        $folderName = $this->folderName;
        $gridName = $this->modelName . '-grid';
        $endGridName = '/' . $this->modelName . '-grid';
        $vueApiRoute = 'api/' . $this->modelName . '-vue';

        //create token array using compact

        $tokens = compact('upperCaseModelName',
                          'field_name',
                          'modelId',
                          'modelAttribute',
                          'createdAt',
                          'modelRoute',
                          'tableName',
                          'masterPage',
                          'modelName',
                          'folderName',
                          'gridName',
                          'endGridName',
                          'vueApiRoute');

        $content = $this->insertTokensInContent($content, $tokens);


        return $content;
    }

    /**
     * @param array $tokens
     */
    private function setTokens(array $tokens)
    {
        foreach ($tokens as $propertyName => $propertyValue) {

            if (property_exists($this, $propertyName)) {

                $this->$propertyName = $propertyValue;

            }


        }
    }

    /**
     * @param $content
     * @param $tokens
     * finds a string in content that starts and ends with :::
     * and replaces with variable value
     * @return mixed
     */
    private function insertTokensInContent($content, $tokens)
    {
        foreach ($tokens as $string => $variable) {

            $content = str_replace(':::' . $string . ':::', $variable, $content);
        }

        return $content;
    }


}
