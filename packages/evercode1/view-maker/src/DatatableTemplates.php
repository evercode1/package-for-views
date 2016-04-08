<?php

namespace Evercode1\ViewMaker;


class DatatableTemplates
{
    public $commonBuilder;

    public function __construct()
    {
        $this->commonBuilder = new CommonTemplates;

    }

    public function buildDtTemplate($filename, $masterPage, $modelName)
    {

        switch ($filename) {

            case 'create' :

                return $this->commonBuilder->commonCreateTemplate($masterPage, $modelName);

            case 'edit' :

                return $this->commonBuilder->commonEditTemplate($masterPage, $modelName);

            case 'show' :

                return $this->commonBuilder->commonShowTemplate($masterPage, $modelName);

            case 'index' :

                return $this->dtIndexTemplate($masterPage, $modelName);

            case 'datatable' :

                return $this->dtDatatableTemplate($masterPage,$modelName);

            case 'datatable-script' :

                return $this->dtDatatableScriptTemplate($masterPage, $modelName);



            default:

                return 'filename not supported';

        }

    }


    public function dtIndexTemplate($masterPage, $modelName)
    {

        return 'just a stub for Index and extend ' . $masterPage;

    }

    public function dtDatatableTemplate($modelName)
    {

        return 'just a stub for datatable';

    }

    public function dtDatatableScriptTemplate($modelName)
    {

        return 'just a stub for datatable-script';

    }
}
