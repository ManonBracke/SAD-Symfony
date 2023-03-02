<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClanMembers
 *
 * @ORM\Table(name="clan_members", uniqueConstraints={@ORM\UniqueConstraint(name="clan_members_player_id_unique", columns={"player_id"})}, indexes={@ORM\Index(name="FK_F3A840C0FE19A1A8", columns={"grade_id"}), @ORM\Index(name="FK_F3A840C0BEAF84C8", columns={"clan_id"})})
 * @ORM\Entity
 */
class ClanMembers
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     * })
     */
    private $player;

    /**
     * @var \Clans
     *
     * @ORM\ManyToOne(targetEntity="Clans")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="clan_id", referencedColumnName="id")
     * })
     */
    private $clan;

    /**
     * @var \ClanGrades
     *
     * @ORM\ManyToOne(targetEntity="ClanGrades")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="grade_id", referencedColumnName="id")
     * })
     */
    private $grade;


}
