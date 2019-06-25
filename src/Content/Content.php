<?php

namespace Malm18\Content;

/**
 * Filter and format text content.
 *
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 * @SuppressWarnings(PHPMD.UnusedPrivateField)
 * @SuppressWarnings(PHPMD.UnusedLocalVariable)
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class Content
{


    /**
     * Sanitize value for output in view.
     *
     * @param string $value to sanitize
     *
     * @return string beeing sanitized
     */
    function esc($value)
    {
        return htmlentities($value);
    }




}
