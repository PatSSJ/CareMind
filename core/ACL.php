<?php
class ACL {

    private static $permisos = [
        '1' => [
            'usuarios.ver',
            'usuarios.crear',
            'usuarios.editar',
            'usuarios.eliminar',
            'medicamentos.ver',
            'medicamentos.crear',
            'medicamentos.editar',
            'medicamentos.eliminar',
            'alarmas.ver',
            'alarmas.crear',
            'alarmas.editar'
            ,'alarmas.eliminar'
        ],

        '2' => [
            'medicamentos.ver',
            'alarmas.ver'
        ],

        '3' => [
            'usuarios.ver',
            'usuarios.crear',
            'usuarios.editar',
            'medicamentos.ver',
            'medicamentos.crear',
            'medicamentos.editar',
            'medicamentos.eliminar'
        ],

        '4' => [
            'usuarios.ver',
            'medicamentos.ver'
        ]
    ];

    public static function puede($accion) {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['rol'])) {
            return false;
        }

        $rol = $_SESSION['rol'];

        if ($rol == 1) {
            return true;
        }

        if (isset(self::$permisos[$rol])) {
            return in_array($accion, self::$permisos[$rol]);
        }

        return false;
    }
}

