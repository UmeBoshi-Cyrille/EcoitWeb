<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[Vich\UploadableField(mapping: 'photo_profil', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable:true)]
    private ?string $imageName = null;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Assert\NotBlank()]
    #[Assert\Email()]
    #[Assert\Length(min: 2, max: 180)]
    private string $email;

    #[ORM\Column(type: 'json')]
    #[Assert\NotNull()]
    private array $roles = [];

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank()]
    private string $password = 'password';

    #[ORM\Column(type: 'string', length: 55, nullable: true)]
    #[Assert\Length(min: 2, max: 55)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(min: 2, max: 55)]
    private string $firstname;

    #[ORM\Column(type: 'string', length: 55, nullable: true)]
    #[Assert\Length(min: 2, max: 55)]
    private string $pseudo;

    #[ORM\Column(type: 'text', nullable: true)]
    private string $description;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Assert\NotNull()]
    private ?DateTimeImmutable $updatedAt;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private bool $RGPDConsent;

    #[ORM\OneToMany(mappedBy: 'instructor', targetEntity: Formation::class)]
    private $formations;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
        $this->setUpdatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_STUDENT';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function hasRole($role)
    {
    return in_array($role, $this->getRoles());
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;
        if ($pseudo) {
            $this->updatedAt = new \DateTime('now');
        return $this;
        }
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    #[ORM\PreUpdate]
    public function setUpdatedAtValue() {
        $this->setUpdatedAt(new \DateTime());
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getRGPDConsent(): ?bool
    {
        return $this->RGPDConsent;
    }

    public function setRGPDConsent(?bool $RGPDConsent): self
    {
        $this->RGPDConsent = $RGPDConsent;

        return $this;
    }

    /**
     * @return Collection<int, Formation>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations[] = $formation;
            $formation->setInstructor($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->removeElement($formation)) {
            // set the owning side to null (unless already changed)
            if ($formation->getInstructor() === $this) {
                $formation->setInstructor(null);
            }
        }

        return $this;
    }

      // /**
    //  * @return null|File
    //  */ 
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * Set the value of imageFile
     *
     * @return  self
     */ 
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return null|string
     */ 
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @param null|string $filename
     *
     * @return  Property
     */ 
    public function setImageName(?string $imageName): User
    {
        $this->imageName = $imageName;

        return $this;
    }
}
