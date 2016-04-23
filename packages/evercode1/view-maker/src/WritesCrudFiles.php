<?php

namespace Evercode1\ViewMaker;

trait WritesCrudFiles
{

    public function makeCrudFiles()
    {

        $this->writeEachFile($this->fileWritePaths);

        $this->appendEachFile($this->fileAppendPaths);

        return $this;
    }

    private function writeEachFile(array $fileNames)
    {

        foreach ($fileNames as $fileName => $filePath) {

            switch($fileName){

                case 'apiController' :

                    if(file_exists($this->fileWritePaths['apiController'])){

                        $fileExists = true;

                        $txt = $this->getContentFromTemplate('apiController', $this->crudTokens, $fileExists);

                        $contents = file_get_contents($this->fileWritePaths['apiController']);

                        $classParts = explode('{', $contents, 2);

                        $txt = $classParts[0]. "{\n\n" . $txt . "\n\n"  . $classParts[1];

                        $handle = fopen($filePath, "w");

                        fwrite($handle, $txt);

                        fclose($handle);

                        break;
                    }

                    $txt = $this->getContentFromTemplate('apiController', $this->crudTokens);

                    $handle = fopen($filePath, "w");

                    fwrite($handle, $txt);

                    fclose($handle);

                    break;

                case 'test':

                    $txt = $this->getContentFromTemplate($fileName, $this->crudTokens);

                    $filePathWeWant = $filePath;

                    $handle = fopen($filePathWeWant, "w");

                    fwrite($handle, $txt);

                    fclose($handle);


                    break;

                default:

                    if ( ! is_array($fileName)) {

                        $txt = $this->getContentFromTemplate($fileName, $this->crudTokens);

                        $handle = fopen($filePath, "w");

                        fwrite($handle, $txt);

                        fclose($handle);
                    }

            }



        }
    }

    private function appendEachFile(array $fileNames)
    {

        foreach ($fileNames as $fileName => $filePath) {

            if ( ! is_array($fileName)) {

                $txt = $this->getContentFromTemplate($fileName, $this->crudTokens);

                $handle = fopen($filePath, "a");

                fwrite($handle, $txt);

                fclose($handle);
            }

        }
    }


}