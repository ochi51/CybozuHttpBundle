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
     * @var TokenStorageInterface
     */
    private $ts;

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
        $this->ts = $ts;
        $this->config = $config;
        $this->certDir = $certDir;
        $this->logfile = $logfile;
        $this->config['logfile'] = $this->logfile;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $user = $this->ts->getToken()->getUser();
        $config = $this->config;

        if ($user instanceof CybozuAccountInterface) {
            $config = $user->getCybozuHttpConfig() + $config;
            $config['debug']   = $user->getDebugMode();
            $config['logfile'] = $this->logfile;
            // This assumes to use KnpGaufretteBundle and VichUploaderBundle.
            // Entity has only key, so can't know directory.
            if (array_key_exists('cert_file', $config)) {
                $config['cert_file'] = $this->certDir . '/' . $config['cert_file'];
            }
        }

        return $config;
    }
}