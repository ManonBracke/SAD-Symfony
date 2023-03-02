<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FailedJobs
 *
 * @ORM\Table(name="failed_jobs", uniqueConstraints={@ORM\UniqueConstraint(name="failed_jobs_uuid_unique", columns={"uuid"})})
 * @ORM\Entity
 */
class FailedJobs
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
     * @ORM\Column(name="uuid", type="string", length=255, nullable=false)
     */
    private $uuid;

    /**
     * @var string
     *
     * @ORM\Column(name="connection", type="text", length=65535, nullable=false)
     */
    private $connection;

    /**
     * @var string
     *
     * @ORM\Column(name="queue", type="text", length=65535, nullable=false)
     */
    private $queue;

    /**
     * @var string
     *
     * @ORM\Column(name="payload", type="text", length=0, nullable=false)
     */
    private $payload;

    /**
     * @var string
     *
     * @ORM\Column(name="exception", type="text", length=0, nullable=false)
     */
    private $exception;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="failed_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $failedAt = 'CURRENT_TIMESTAMP';


}
