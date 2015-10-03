<?php

namespace CybozuHttpBundle\Entity;


/**
 * @author ochi51 <ochiai07@gmail.com>
 */
interface CybozuAccountInterface
{

    /**
     * get cybozu_http.client service arguments
     * @see \CybozuHttpBundle\DependencyInjection\CybozuHttpExtension::setParameters
     *
     * @return array
     */
    public function getCybozuHttpConfig();

    /**
     * get debug mode boolean
     *
     * @return bool
     */
    public function getDebugMode();
}