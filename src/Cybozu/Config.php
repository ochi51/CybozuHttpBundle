<?php

namespace CybozuHttpBundle\Cybozu;

use CybozuHttpBundle\Entity\CybozuAccountInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @author ochi51 <ochiai07@gmail.com>
 */
class Config
{
    /**
     * @var array
     */
    private $config;

    /**
     * @param TokenStorageInterface $ts
     * @param array $config
     * @param string|null $certDir
     * @param string|null $logfile
     */
    public function __construct(TokenStorageInterface $ts, array $config = [], $certDir = null, $logfile = null)
    {
        $user = $ts->getToken()->getUser();

        if ($user instanceof CybozuAccountInterface) {
            $config = $user->getCybozuHttpConfig();
            $config['debug']   = $user->getDebugMode();
            $config['logfile'] = $logfile;
            // This assumes to use KnpGaufretteBundle and VichUploaderBundle.
            // Entity has only key, so can't know directory.
            $config['certFile'] = $certDir . '/' . $config['certFile'];
        }

        $this->config = $config;
    }

    public function toArray()
    {
        return $this->config;
    }
}