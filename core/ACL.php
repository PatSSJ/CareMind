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
	    'alarmas.editar',
	    'alarmas.eliminar'
        ],
       
	'2' => [
            'medicamentos.ver',
            'alarmas.ver',
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
	if (!isset($_SESSION['rol'])) { 
	return false; 
	
	} 
	
	$rol = $_SESSION['rol'];

        if (!isset(self::$permisos[$rol])) {
                return false;
        }

        return in_array($accion, self::$permisos[$rol]);
    }
}

