<?php

namespace Evercode1\ViewMaker;

class FormatsTokens
{
    public $modelName;
    public $folderName;
    public $masterPage;

    public function __construct($masterPage, $modelName, $folderName)
    {

        $this->modelName = $modelName;
        $this->folderName = $folderName;
        $this->masterPage = $masterPage;



    }

    public function formatTokens()
    {
        $upperCaseModelName = ucfirst($this->modelName);
        $field_name = snake_case($this->modelName) . '_name';
        $modelId = $this->modelName . '->id';
        $modelAttribute = $this->modelName . '->' . $field_name;
        $createdAt = $this->modelName . '->created_at';
        $modelRoute = $this->folderName;
        $tableName = $this->modelName . '_table';
        $masterPage = $this->masterPage;
        $modelName = $this->modelName;
        $folderName = $this->folderName;


        return [$upperCaseModelName,
                $field_name,
                $modelId,
                $modelAttribute,
                $createdAt,
                $modelRoute,
                $tableName,
                $masterPage,
                $modelName,
                $folderName];
    }



}
