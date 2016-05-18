<?php

namespace Evercode1\ViewMaker;

trait HasParentAndChildAndSlug
{

    private function hasSlug(array $tokens)
    {

        return $tokens['slug'] == 'slug';


    }

    /**
     * @param array $tokens
     * @return bool
     */
    private function hasParent(array $tokens)
    {
        return isset($tokens['parent']);
    }

    /**
     * @param array $tokens
     * @return bool
     */
    private function isParent(array $tokens)
    {
        return $tokens['parent'] == $tokens['model'];
    }

    /**
 * @param array $tokens
 * @return bool
 */
    private function isChild(array $tokens)
    {
        return $tokens['child'] == $tokens['model'];
    }

    /**
     * @param array $tokens
     * @return bool
     */
    private function isViewChild(array $tokens)
    {
        return $tokens['child'] == $tokens['modelName'];
    }

    /**
     * @param array $tokens
     * @return bool
     */
    private function hasChild(array $tokens)
    {
        return isset($tokens['child']);
    }





}