<?php

namespace Evercode1\ViewMaker;

trait BuildsTemplates
{

    private function getTemplate($fileName, $templateType, array $tokens)
    {


        switch($templateType){

            case 'plain' :
                return $this->buildPlainTemplate($fileName, $tokens);
                break;

            case 'basic' :
                return $this->buildBasicTemplate($fileName, $tokens);
                break;

            case 'dt' :
                return $this->buildDtTemplate($fileName, $tokens);
                break;

            case 'vue' :
                return $this->buildVueTemplate($fileName, $tokens);
                break;

            default :

                return 'just a stub for ' . $fileName;



        }

    }

    public function buildBasicTemplate($fileName, array $tokens)
    {

        $basicTemplateBuilder = new BasicTemplates($tokens);

        $commonTemplateBuilder = new CommonTemplates($tokens);

        switch ($fileName) {

            case 'create' :

                if ($this->hasChild($tokens) && $this->isViewChild($tokens)){


                       return $commonTemplateBuilder->commonChildCreateTemplate();
                       break;


                }


                return $commonTemplateBuilder->commonCreateTemplate();
                break;

            case 'edit' :

                if ($this->hasChild($tokens) && $this->isViewChild($tokens)){


                        return $commonTemplateBuilder->commonChildEditTemplate();
                        break;


                }

                return $commonTemplateBuilder->commonEditTemplate();
                break;

            case 'show' :

                if ($this->hasChild($tokens) && $this->isViewChild($tokens)){

                        return $commonTemplateBuilder->commonChildShowTemplate();
                        break;

                }

                return $commonTemplateBuilder->commonShowTemplate();
                break;

            case 'index' :

                return $basicTemplateBuilder->basicIndexTemplate();
                break;

            default:

                return 'filename not supported';

        }


    }

    public function buildDtTemplate($fileName, array $tokens)
    {

        $dtTemplateBuilder = new DatatableTemplates($tokens);

        $commonTemplateBuilder = new CommonTemplates($tokens);

        switch ($fileName) {

            case 'create' :

                if ($this->hasChild($tokens) && $this->isViewChild($tokens)){


                        return $commonTemplateBuilder->commonChildCreateTemplate();
                        break;


                }

                return $commonTemplateBuilder->commonCreateTemplate();
                break;

            case 'edit' :

                if ($this->hasChild($tokens) && $this->isViewChild($tokens)){


                        return $commonTemplateBuilder->commonChildEditTemplate();
                        break;


                }

                return $commonTemplateBuilder->commonEditTemplate();
                break;

            case 'show' :

                if ($this->hasChild($tokens) && $this->isViewChild($tokens)){


                        return $commonTemplateBuilder->commonChildShowTemplate();
                        break;


                }


                return $commonTemplateBuilder->commonShowTemplate();
                break;

            case 'index' :

                return $dtTemplateBuilder->dtIndexTemplate();
                break;

            case 'datatable' :

                if ($this->hasChild($tokens)  && $this->isViewChild($tokens)){

                        if ($this->hasSlug($tokens)){

                            return $dtTemplateBuilder->dtChildDatatableSlugTemplate();
                            break;
                        }

                        return $dtTemplateBuilder->dtChildDatatableTemplate();
                        break;


                }

                if ($this->hasSlug($tokens)){

                    return $dtTemplateBuilder->dtDatatableSlugTemplate();
                    break;

                }

                return $dtTemplateBuilder->dtDatatableTemplate();
                break;

            case 'datatable-script' :

                if ($this->hasChild($tokens) && $this->isViewChild($tokens)){

                        if ($this->hasSlug($tokens)){

                            return $dtTemplateBuilder->dtChildDatatableScriptSlugTemplate();
                            break;
                        }

                        return $dtTemplateBuilder->dtChildDatatableScriptTemplate();
                        break;

                }

                if ($this->hasSlug($tokens)){

                    return $dtTemplateBuilder->dtDatatableScriptSlugTemplate();
                    break;
                }

                return $dtTemplateBuilder->dtDatatableScriptTemplate();
                break;

            default:

                return 'filename not supported';

        }

    }

    public function buildPlainTemplate($fileName, array $tokens)
    {
        $plainTemplateBuilder = new PlainTemplates($tokens);

        switch($fileName){

            case 'create' :

                return $plainTemplateBuilder->plainCreateTemplate();

            case 'show' :

                return $plainTemplateBuilder->plainShowTemplate();

            case 'edit' :

                return $plainTemplateBuilder->plainEditTemplate();

            case 'index' :

                return $plainTemplateBuilder->plainIndexTemplate();

            default:

                return 'filename not supported';



        }

    }

    public function buildVueTemplate($fileName, array $tokens)
    {

        $vueTemplateBuilder = new VueTemplates($tokens);

        $commonTemplateBuilder = new CommonTemplates($tokens);

        switch ($fileName) {

            case 'create' :

                if ($this->hasChild($tokens) && $this->isViewChild($tokens)){

                        return $commonTemplateBuilder->commonChildCreateTemplate();

                }

                return $commonTemplateBuilder->commonCreateTemplate();

            case 'edit' :

                if ($this->hasChild($tokens) && $this->isViewChild($tokens)){

                        return $commonTemplateBuilder->commonChildEditTemplate();

                }

                return $commonTemplateBuilder->commonEditTemplate();

            case 'show' :

                if ($this->hasChild($tokens) && $this->isViewChild($tokens)){

                        return $commonTemplateBuilder->commonChildShowTemplate();

                }

                return $commonTemplateBuilder->commonShowTemplate();

            case 'index' :

                if ($this->hasChild($tokens) && $this->isViewChild($tokens)){

                        if ($this->hasSlug($tokens)){

                            return $vueTemplateBuilder->vueChildIndexSlugTemplate();
                        }

                        return $vueTemplateBuilder->vueChildIndexTemplate();

                }

                if ($this->hasSlug($tokens)){

                    return $vueTemplateBuilder->vueIndexSlugTemplate();
                }

                return $vueTemplateBuilder->vueIndexTemplate();

            default:

                return 'filename not supported';

        }


    }

}