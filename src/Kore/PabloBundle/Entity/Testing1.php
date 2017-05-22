<?php 
 
namespace Kore\PabloBundle\Entity;

class Testing {
    private $nombre;
    private $apellido;


    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
        return $this;
    }


}