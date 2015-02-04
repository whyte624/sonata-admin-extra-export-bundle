<?php

namespace Whyte624\SonataAdminExtraExportBundle\Admin;

trait AdminExtraExportTrait
{
    public function getExportFormats()
    {
        $formats = parent::getExportFormats();
        return array_merge($formats, array('pdf', 'jpg'));
    }
}
