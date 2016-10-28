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
     * @var CybozuAccountInterface
     */
    private $user;

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
     * @param string|null $certDir
     * @param string|null $logfile
     */
    public function __construct(TokenStorageInterface $ts, $certDir = null, $logfile = null)
    {
        $this->ts = $ts;
        $this->certDir = $certDir;
        $this->logfile = $logfile;

        $token = $ts->getToken();
        if ($token && $token->getUser() instanceof CybozuAccountInterface) {
            $this->user = $token->getUser();
        }
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        if ($this->user instanceof CybozuAccountInterface) {
            $config = $this->user->getCybozuHttpConfig();
            $config['debug']   = $this->user->getDebugMode();
            $config['logfile'] = $this->logfile;
            // This assumes to use KnpGaufretteBundle and VichUploaderBundle.
            // Entity has only key, so can't know directory.
            if (array_key_exists('cert_file', $config)) {
                $config['cert_file'] = $this->certDir . '/' . $config['cert_file'];
            }

            return $config;
        }

        throw new \RuntimeException('User in token and this user done not implement CybozuAccountInterface.');
    }

    /**
     * @param CybozuAccountInterface $user
     * @return self
     */
    public function setUser(CybozuAccountInterface $user)
    {
        $this->user = $user;

        return $this;
    }
}