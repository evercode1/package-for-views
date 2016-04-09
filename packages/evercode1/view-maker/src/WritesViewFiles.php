<?php

namespace Evercode1\ViewMaker;

trait WritesViewFiles
{

    // make view directory

    private function makeViewDirectory()
    {


        if (file_exists(base_path($this->folderPath)))
        {

            $this->error($this->modelName. ' folder already exists!');

            die();

        }

        mkdir(base_path($this->folderPath));

        return $this;
    }


    //make view files based on type, plain, basic or dt

    private function makeViewFiles($templateType)
    {

        switch($templateType){

            case 'plain' :

                return $this->makeFiles('plain');

                break;

            case 'basic'  :

                return $this->makeFiles('basic');

                break;

            case 'dt'  :

                return $this->makeFiles('dt');

                break;

            default:

                $this->error($templateType . ' is not a valid type');

                die();

        }


    }


    private function makeFiles($templateType)
    {

        $this->writeFiles($templateType);

        return $this;

    }

    /**
     * @param $type
     * use the $this->paths array to get name of each file, then call writeEachFile
     */
    private function writeFiles($templateType)
    {
        //extract file names from $this->paths array, $fileNames is an array,
        // so loop through with writeEachFile
        foreach ($this->paths as $numericKey => $fileNames) {

            $this->writeEachFile($templateType, $fileNames);

        }
    }

    /**
     * @param $type
     * @param $name
     *
     * creates the files
     * $fileNames is handed in as an array
     * calls getTemplate from the BuildsTemplates trait
     */
    private function writeEachFile($templateType, array $fileNames)
    {
        foreach ($fileNames as $fileName => $filepath) {

            if ( ! is_array($fileName)) {

                $txt = $this->getTemplate($fileName,
                                          $templateType,
                                          $this->tokens);

                $handle = fopen($filepath, "w");

                fwrite($handle, $txt);

                fclose($handle);
            }

        }
    }

}