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
     * @var CybozuAccountInterface
     */
    private $user;

    /**
     * @var array
     */
    private $config;

    /**
     * @var string
     */
    private $certDir;

    /**
     * @var string
     */
    private $logfile;

    /**
     * @param TokenStorageInterface $ts
     * @param array $config
     * @param string|null $certDir
     * @param string|null $logfile
     */
    public function __construct(TokenStorageInterface $ts, array $config = [], $certDir = null, $logfile = null)
    {
        $this->user = $ts->getToken()->getUser();
        $this->config = $config;
        $this->certDir = $certDir;
        $this->logfile = $logfile;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        if ($this->user instanceof CybozuAccountInterface) {
            $config = $this->user->getCybozuHttpConfig();
            $config['debug']   = $this->user->getDebugMode();
            $config['logfile'] = $this->logfile;
            // This assumes to use KnpGaufretteBundle and VichUploaderBundle.
            // Entity has only key, so can't know directory.
            $config['cert_file'] = $this->certDir . '/' . $config['cert_file'];

            return $config;
        }

        return $this->config;
    }
}