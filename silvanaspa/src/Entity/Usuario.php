<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\FormTypeInterface;

/**
 * Usuario
 *
 * @ORM\Entity, @ORM\Entity(repositoryClass=UsuarioRepository::class)
 */
class Usuario implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="apellido", type="string", length=255, nullable=true)
     */
    private $apellido;

    /**
     * @var string|null
     *
     * @ORM\Column(name="identificacion", type="string", length=255, nullable=true)
     */
    private $identificacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @var string|null
     *
     * @ORM\Column(name="celular", type="string", length=10, nullable=true)
     */
    private $celular;

    /**
     * @var string|null
     *
     * @ORM\Column(name="correo", type="string", length=255, nullable=true)
     */
    private $correo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="foto", type="string", length=255, nullable=true)
     */
    private $foto;

    /**
     * @var string|null
     *
     * @ORM\Column(name="login", type="string", length=255, nullable=true)
     */
    private $login;

    /**
     * @var string|null
     *
     * @ORM\Column(name="clave", type="string", length=255, nullable=true)
     */
    private $clave;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_cambio_pass", type="datetime", nullable=true)
     */
    private $fechaCambioPass;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="creditos", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $creditos;

    /**
     * @var string|null
     *
     * @ORM\Column(name="terminos_path", type="string", length=255, nullable=true)
     */
    private $terminosPath;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_aceptacion", type="datetime", nullable=true)
     */
    private $fechaAceptacion;

    /**
     * @var \TipoIdentificacion
     *
     * @ORM\ManyToOne(targetEntity="TipoIdentificacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_identificacion_id", referencedColumnName="id")
     * })
     */
    private $tipoIdentificacion;

    /**
     * @var \Rol
     *
     * @ORM\ManyToOne(targetEntity="Rol")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rol_id", referencedColumnName="id")
     * })
     */
    private $rol;

    /**
     * @var \EstadoUsuario
     *
     * @ORM\ManyToOne(targetEntity="EstadoUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado_usuario_id", referencedColumnName="id")
     * })
     */
    private $estadoUsuario;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(?string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getIdentificacion(): ?string
    {
        return $this->identificacion;
    }

    public function setIdentificacion(?string $identificacion): self
    {
        $this->identificacion = $identificacion;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getCelular(): ?string
    {
        return $this->celular;
    }

    public function setCelular(?string $celular): self
    {
        $this->celular = $celular;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(?string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getClave(): ?string
    {
        return $this->clave;
    }

    public function setClave(?string $clave): self
    {
        $this->clave = $clave;

        return $this;
    }

    public function getFechaRegistro(): ?\DateTimeInterface
    {
        return $this->fechaRegistro;
    }

    public function setFechaRegistro(?\DateTimeInterface $fechaRegistro): self
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    public function getFechaCambioPass(): ?\DateTimeInterface
    {
        return $this->fechaCambioPass;
    }

    public function setFechaCambioPass(?\DateTimeInterface $fechaCambioPass): self
    {
        $this->fechaCambioPass = $fechaCambioPass;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(?bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

    public function getCreditos(): ?int
    {
        return $this->creditos;
    }

    public function setCreditos(?int $creditos): self
    {
        $this->creditos = $creditos;

        return $this;
    }

    public function getTerminosPath(): ?string
    {
        return $this->terminosPath;
    }

    public function setTerminosPath(?string $terminosPath): self
    {
        $this->terminosPath = $terminosPath;

        return $this;
    }

    public function getFechaAceptacion(): ?\DateTimeInterface
    {
        return $this->fechaAceptacion;
    }

    public function setFechaAceptacion(?\DateTimeInterface $fechaAceptacion): self
    {
        $this->fechaAceptacion = $fechaAceptacion;

        return $this;
    }

    public function getTipoIdentificacion(): ?TipoIdentificacion
    {
        return $this->tipoIdentificacion;
    }

    public function setTipoIdentificacion(?TipoIdentificacion $tipoIdentificacion): self
    {
        $this->tipoIdentificacion = $tipoIdentificacion;

        return $this;
    }

    public function getRol(): ?Rol
    {
        return $this->rol;
    }

    public function setRol(?Rol $rol): self
    {
        $this->rol = $rol;

        return $this;
    }

    public function getEstadoUsuario(): ?EstadoUsuario
    {
        return $this->estadoUsuario;
    }

    public function setEstadoUsuario(?EstadoUsuario $estadoUsuario): self
    {
        $this->estadoUsuario = $estadoUsuario;

        return $this;
    }
    /* ----------------------------------------------------------------------------------*/
    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->login;
    }

    /**
     * @see UserInterface
     */
    public function getRoles()
    {
        $roles[] = $this->getRol()->getNombre();
        return $roles;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->clave;
    }

    public function setPassword(string $password): self
    {
        $this->clave = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function __toString()
    {
        return (string) $this->getNombre().' '.$this->getApellido();
    }
}
