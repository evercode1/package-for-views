<?php

namespace Evercode1\ViewMaker;

trait BuildsCrudTemplates
{

    private $crudTemplate;

    private function getContentFromTemplate($fileName,  array $tokens, $fileExists=false)
    {

        switch($fileName){

            case 'model' :

                if ($this->hasParent($tokens) &&  $this->isParent($tokens)){

                        if ($this->hasSlug($tokens)){

                            return $this->buildTemplate($tokens, 'parentModelSlugTemplate');
                            break;
                        }

                        return $this->buildTemplate($tokens, 'parentModelTemplate');
                        break;

                    } else {

                        if ($this->isChild($tokens)) {

                            if ($this->hasSlug($tokens)){

                                return $this->buildTemplate($tokens, 'childModelSlugTemplate');
                                break;


                            }

                            return $this->buildTemplate($tokens, 'childModelTemplate');
                            break;
                        }

                    }

                if ($this->hasSlug($tokens)){

                    return $this->buildTemplate($tokens, 'modelSlugTemplate');
                    break;

                }

                return $this->buildTemplate($tokens, 'modelTemplate');
                break;

            case 'controller' :

                if ($this->hasChild($tokens) && $this->isChild($tokens)){

                            if ($this->hasSlug($tokens)){

                                return $this->buildTemplate($tokens, 'childControllerSlugTemplate');
                                break;
                            }

                            return $this->buildTemplate($tokens, 'childControllerTemplate');
                            break;


                }

                if ($this->hasSlug($tokens)){

                    return $this->buildTemplate($tokens, 'controllerSlugTemplate');
                    break;

                }

                return $this->buildTemplate($tokens, 'controllerTemplate');
                break;

            case 'apiController' :

                if ($fileExists){

                    if ($this->hasChild($tokens) && $this->isChild($tokens)){

                            if ($this->hasSlug($tokens)){

                                return $this->buildTemplate($tokens, 'childAppendApiControllerSlugTemplate');
                                break;


                            }

                            return $this->buildTemplate($tokens, 'childAppendApiControllerTemplate');
                            break;


                    }

                    if ($this->hasSlug($tokens)){

                        return $this->buildTemplate($tokens, 'appendApiControllerSlugTemplate');
                        break;
                    }

                    return $this->buildTemplate($tokens, 'appendApiControllerTemplate');
                    break;

                } else {

                    if ($this->hasChild($tokens) && $this->isChild($tokens)){

                            if ($this->hasSlug($tokens)){

                                return $this->buildTemplate($tokens, 'childApiControllerSlugTemplate');
                                break;


                            }

                            return $this->buildTemplate($tokens, 'childApiControllerTemplate');
                            break;


                    }

                    if ($this->hasSlug($tokens)){

                        return $this->buildTemplate($tokens, 'apiControllerSlugTemplate');
                        break;
                    }

                    return $this->buildTemplate($tokens, 'apiControllerTemplate');
                    break;

                }


            case 'migration' :

                if ($this->hasChild($tokens) && $this->isChild($tokens)){

                        if ($this->hasSlug($tokens)){

                            return $this->buildTemplate($tokens, 'childMigrationSlugTemplate');
                            break;
                        }

                        return $this->buildTemplate($tokens, 'childMigrationTemplate');
                        break;


                }

                if ($this->hasSlug($tokens)){

                    return $this->buildTemplate($tokens, 'migrationSlugTemplate');
                    break;

                }

                return $this->buildTemplate($tokens, 'migrationTemplate');
                break;

            case 'routes' :

                if ($this->hasSlug($tokens)){

                    return $this->buildTemplate($tokens, 'routeSlugTemplate');
                    break;
                }

                return $this->buildTemplate($tokens, 'routeTemplate');
                break;

            case 'factory' :

                if ($this->hasChild($tokens) && $this->isChild($tokens)){

                        if ($this->hasSlug($tokens)){

                            return $this->buildTemplate($tokens, 'childFactorySlugTemplate');
                            break;
                        }

                        return $this->buildTemplate($tokens, 'childFactoryTemplate');
                        break;
                    }


                if ($this->hasSlug($tokens)){

                    return $this->buildTemplate($tokens, 'factorySlugTemplate');
                    break;
                }

                return $this->buildTemplate($tokens, 'factoryTemplate');
                break;

            case 'test' :

                if ($this->hasChild($tokens)  && $this->isChild($tokens)){


                        return $this->buildTemplate($tokens, 'childTestTemplate');
                        break;


                }


                return $this->buildTemplate($tokens, 'testTemplate');
                break;


            default :

                return 'Something went wrong';



        }

    }

    private function buildTemplate($tokens, $template)
    {

        $this->setTemplateInstance($tokens);

        return $this->crudTemplate->$template();


    }

    private function setTemplateInstance($tokens)
    {
        $this->crudTemplate = new CrudTemplates($tokens);

    }

}