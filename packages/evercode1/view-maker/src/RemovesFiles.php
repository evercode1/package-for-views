<?php

namespace Evercode1\ViewMaker;

use App\Http\Controllers\ApiController;

trait RemovesFiles
{

    private $unlinkFiles = [];

    private $extractFromFiles = [];

    private $modelName;

    private $modelPath;

    private $parentName;

    private $childName;

    public function deleteDirectoryAndFiles($path)
    {
        if (empty($path) || ! $this->folderExists($path)){

            return false;

        }
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($files as $fileinfo) {
            $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
            $todo($fileinfo->getRealPath());
        }

        return rmdir($path);



    }

    private function folderExists($path)
    {

        return file_exists($path);


    }

    private function setPaths()
    {

        $this->unlinkFiles['model'] = base_path('app/' . $this->modelName .'.php');
        $this->unlinkFiles['controller'] = base_path('app/Http/Controllers/' . $this->modelName) . 'Controller.php';
        $this->unlinkFiles['test'] =  base_path('tests/' . $this->modelName . 'Test.php');
        $this->unlinkFiles['migration'] = $this->getMigrationFilePath($this->modelName);
        $this->extractFromFiles['Factory'] = base_path('database/factories/ModelFactory.php');
        $this->extractFromFiles['Routes'] = base_path('app/Http/routes.php');
        $this->extractFromFiles['Api Methods'] = base_path('app/Http/Controllers/ApiController.php');
    }


    private function getMigrationFilePath($model)
    {

        $migrationModelName = str_plural(snake_case($model));

        $file = 'create_' .$migrationModelName . '_table';

        $migrations = scandir(base_path('database/migrations')) ;

        foreach ($migrations as $migration){

            if( str_contains($migration, $file)){

                $file = $migration;
            }

        }

        return base_path('database/migrations/') . $file;

    }



    private function deleteCrudFiles()
    {

        foreach ($this->unlinkFiles as $crudFile){

            unlink($crudFile);
        }

        $this->extractMethodsFromFiles();

        //call delete each crud from trait

        return $this;


    }

    private function extractMethodsFromFiles()
    {

        foreach($this->extractFromFiles as $type => $file){

            $start = '// Begin ' . $this->modelName . ' ' .  $type ;

            $end = '// End ' . $this->modelName . ' ' . $type;

            $replaceWith = "";

            //read the entire string from file

            $content = file_get_contents($file);

            // define pattern

            $stringToDelete = $this->patternMatch($start, $end, $content);

            //replace the file string

            $updatedContent = str_replace("$stringToDelete", "$replaceWith", $content);

            //writes the entire file with updated content

            file_put_contents($file, $updatedContent);

        }

            $this->removeApiControllerIfEmpty();

    }

    private function removeApiControllerIfEmpty()
    {
        $file = $this->extractFromFiles['Api Methods'];

        $content = file_get_contents($file);

        if( ! str_contains($content, '// Begin')){

            unlink($file);
        }


    }

    /**
     * @param $start
     * @param $end
     * @param $str
     * @param $matches
     * @return null
     */
    private function patternMatch($start, $end, $str)
    {
        $pattern = sprintf(
            '/%s(.+?)%s/ims',
            preg_quote($start, '/'), preg_quote($end, '/')
        );

        // set existing to matches[0] because it'a an array

        if (preg_match($pattern, $str, $matches)) {

            $existing = ($matches[0]);

            return $existing;

        } else {

            $existing = null;

            return $existing;
        }
    }





}