<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table("users")
 */
class User implements \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $googleId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $emailVerified;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $givenName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $familyName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $locale;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lyric", mappedBy="user")
     */
    private $lyrics;

    public function __construct() {
        $this->lyrics = new ArrayCollection();
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGoogleId(): ?string
    {
        return $this->googleId;
    }

    public function setGoogleId(string $googleId): self
    {
        $this->googleId = $googleId;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getEmailVerified(): ?bool
    {
        return $this->emailVerified;
    }

    public function setEmailVerified(bool $emailVerified): self
    {
        $this->emailVerified = $emailVerified;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getGivenName(): ?string
    {
        return $this->givenName;
    }

    public function setGivenName(string $givenName): self
    {
        $this->givenName = $givenName;

        return $this;
    }

    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    public function setFamilyName(string $familyName): self
    {
        $this->familyName = $familyName;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getLyrics(): Collection
    {
        return $this->lyrics;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'googleId' => $this->getGoogleId(),
            'email' => $this->getEmail(),
            'emailVerified' => $this->getEmailVerified(),
            'name' => $this->getName(),
            'givenName' => $this->getGivenName(),
            'familyName' => $this->getFamilyName(),
            'picture' => $this->getPicture(),
            'locale' => $this->getLocale(),
            'accessToken' => uniqid(uniqid(uniqid(uniqid(uniqid())))),
        ];
    }

    public function setByObj($userStd) {
        $this->setId($userStd->id);
        $this->setGoogleId($userStd->googleId);
        $this->setEmail($userStd->email);
        $this->setEmailVerified($userStd->emailVerified);
        $this->setName($userStd->name);
        $this->setGivenName($userStd->givenName);
        $this->setFamilyName($userStd->familyName);
        $this->setpicture($userStd->picture);
        $this->setLocale($userStd->locale);
    }

    public function setByToken($token) {
        $data64 = explode('.', $token)[1];
        $userStd = json_decode(base64_decode($data64));

        $this->setByObj($userStd);
    }
}
