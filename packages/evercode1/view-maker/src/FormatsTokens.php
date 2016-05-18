<?php

namespace Evercode1\ViewMaker;

class FormatsTokens
{
    public $modelName;
    public $folderName;
    public $masterPage;
    public $parent;
    public $child;
    public $slug;

    public function __construct(array $tokens)
    {


        $this->setTokens($tokens);
        $this->modelName = camel_case($this->modelName);

    }

    public function formatTokens($content)
    {
        $upperCaseModelName = ucfirst($this->modelName);
        $field_name = snake_case($this->modelName) . '_name';
        $modelId = $this->formatInstanceVariable() . '->id';
        $modelAttribute = $this->formatInstanceVariable() . '->' . $field_name;
        $createdAt = $this->formatInstanceVariable() . '->created_at';
        $modelRoute = '/' . $this->folderName;
        $dtTableName = snake_case($this->modelName) . '_table';
        $masterPage = $this->masterPage;
        $modelName = $this->modelName;
        $modelsUpperCase = ucwords(str_plural($this->modelName));
        $folderName = $this->folderName;
        $gridName = $this->formatVueGridName() . '-grid';
        $endGridName = '/' . $this->formatVueGridName() . '-grid';
        $vueApiRoute = 'api/' . $this->folderName . '-vue';
        $parent = $this->parent;
        $parentInstance = $this->formatParentInstanceVariable($this->parent);
        $parentInstances = $this->formatParents($this->parent);
        $parent_id = strtolower(snake_case($this->parent)) . '_id';
        $parentFieldName = strtolower(snake_case($this->parent)) . '_name';
        $child = $this->child;
        $slug = $this->slug;

        //create token array using compact

        $tokens = compact('upperCaseModelName',
                          'field_name',
                          'modelId',
                          'modelAttribute',
                          'createdAt',
                          'modelRoute',
                          'dtTableName',
                          'masterPage',
                          'modelName',
                          'modelsUpperCase',
                          'folderName',
                          'gridName',
                          'endGridName',
                          'vueApiRoute',
                          'parent',
                          'parentInstance',
                          'parentInstances',
                          'parent_id',
                          'parentFieldName',
                          'child',
                          'slug');

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

    private function formatInstanceVariable()
    {

        return camel_case($this->modelName);
    }

    private function formatParentInstanceVariable()
    {

        return camel_case($this->parent);
    }

    private function formatVueGridName()
    {
        $gridName = preg_split('/(?=[A-Z])/',$this->modelName);

        $gridName = implode('-', $gridName);

        $gridName = ltrim($gridName, '-');

        return $gridName = strtolower($gridName);

    }

    private function formatParents($parent)
    {

        $parent = strtolower($parent);

        return str_plural($parent);


    }


}
