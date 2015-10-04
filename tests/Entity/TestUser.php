<?php

namespace CybozuHttpBundle\Tests\Entity;

use CybozuHttpBundle\Entity\CybozuAccountInterface;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @author ochi51 <ochiai07@gmail.com>
 */
class TestUser implements UserInterface, CybozuAccountInterface
{
    /**
     * @inheritDoc
     */
    public function getCybozuHttpConfig()
    {
        return [
            "domain" =>         "cybozu.com",
            "subdomain" =>      "changeMe",
            "use_api_token" =>    false,
            "login" =>          "changeMe",
            "password" =>       "changeMe",
            "token" =>          null,
            "use_basic" =>       false,
            "basic_login" =>     null,
            "basic_password" =>  null,
            "use_client_cert" =>  false,
            "cert_file" =>       "cert.pem",
            "cert_password" =>   null
        ];
    }

    /**
     * @inheritDoc
     */
    public function getDebugMode()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return 'password';
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return 'salt';
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return 'test@ochi51.com';
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials() {}
}