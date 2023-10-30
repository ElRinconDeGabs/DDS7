<?php
require_once('modelo.php');

class Usuarios extends modeloCredencialesBD {
    
    public function __construct() {
        parent::__construct();
    }

    public function validar_usuario($usr, $pwd) {
        $instruccion = "CALL sp_validar_usuario(?, ?)";

        $stmt = $this->_db->prepare($instruccion);
        $stmt->bind_param("ss", $usr, $pwd);
        $stmt->execute();

        $resultado = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        $this->_db->close();

        return $resultado;
    }
}
