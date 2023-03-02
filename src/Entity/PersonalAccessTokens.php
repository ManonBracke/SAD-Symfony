<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonalAccessTokens
 *
 * @ORM\Table(name="personal_access_tokens", uniqueConstraints={@ORM\UniqueConstraint(name="personal_access_tokens_token_unique", columns={"token"})}, indexes={@ORM\Index(name="personal_access_tokens_tokenable_type_tokenable_id_index", columns={"tokenable_type", "tokenable_id"})})
 * @ORM\Entity
 */
class PersonalAccessTokens
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tokenable_type", type="string", length=255, nullable=false)
     */
    private $tokenableType;

    /**
     * @var int
     *
     * @ORM\Column(name="tokenable_id", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $tokenableId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=64, nullable=false)
     */
    private $token;

    /**
     * @var string|null
     *
     * @ORM\Column(name="abilities", type="text", length=65535, nullable=true)
     */
    private $abilities;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="last_used_at", type="datetime", nullable=true)
     */
    private $lastUsedAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="expires_at", type="datetime", nullable=true)
     */
    private $expiresAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;


}
