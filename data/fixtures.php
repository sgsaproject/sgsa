<?php

/**
 * Inserindo valores padrões
 */
echo 'Inserindo dados padrões' . BREAK_LINE;

$db->insert('tipo_usuario', array('nome' => 'Organizador', 'alias' => 'organizador'));
$db->insert('tipo_usuario', array('nome' => 'Colaborador', 'alias' => 'colaborador'));
$db->insert('tipo_usuario', array('nome' => 'Administrador', 'alias' => 'administrador'));

$db->insert('usuario', array('nome' => 'Administrador', 'login' => 'admin', 'senha' => 'admin', 'id_tipo_usuario' => 3));

if (APPLICATION_ENV == 'development'):
    
    
    
endif;

if (APPLICATION_ENV == 'staging' || APPLICATION_ENV == 'production'):

    
    
endif;

if (APPLICATION_ENV == 'testing'):
    
    
    
endif;