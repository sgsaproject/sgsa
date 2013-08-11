<?php

/**
 * Inserindo valores padrões
 */
echo 'Inserindo dados padrões' . BREAK_LINE;

$db->insert('tipo_usuario', array('id_tipo_usuario' => 1, 'nome' => 'Organizador', 'alias' => 'organizador'));
$db->insert('tipo_usuario', array('id_tipo_usuario' => 2, 'nome' => 'Colaborador', 'alias' => 'colaborador'));
$db->insert('tipo_usuario', array('id_tipo_usuario' => 3, 'nome' => 'Administrador', 'alias' => 'administrador'));
$db->insert('tipo_usuario', array('id_tipo_usuario' => 4, 'nome' => 'Participante', 'alias' => 'participante'));

$db->insert('usuario', array('nome' => 'Administrador', 'email' => 'admin@admin.com', 'senha' => 'admin', 'codigo_barras' => '', 'id_tipo_usuario' => 3));

$db->insert('configuracao', array('inscricoes_abertas' => false));

if (APPLICATION_ENV == 'development' || APPLICATION_ENV == 'testing'):
    
    $db->insert('usuario', array('nome' => 'João da Silva', 'email' => 'joaodasilva@sacta.com', 'senha' => '12345', 'rg' => '1234554321', 'curso' => 'Engenhria Mecânica', 'instituicao' => 'Unipampa', 'pagamento' => 'naopago', 'impresso' => 0, 'codigo_barras' => 97885, 'id_tipo_usuario' => 4));
    $db->insert('usuario', array('nome' => 'Maria Josefina', 'email' => 'mariajs@sacta.com', 'senha' => 'maria', 'rg' => '0987654321', 'curso' => 'Engenhria Civil', 'instituicao' => 'Unipampa', 'pagamento' => 'naopago', 'impresso' => 0, 'codigo_barras' => 98534, 'id_tipo_usuario' => 4));
    $db->insert('usuario', array('nome' => 'Pedro Barbosa', 'email' => 'pedrobb@sacta.com', 'senha' => 'senhadoida', 'rg' => '76767676767', 'curso' => 'Engenhria Elétrica', 'instituicao' => 'Unipampa', 'pagamento' => 'naopago', 'impresso' => 0, 'codigo_barras' => 54543, 'id_tipo_usuario' => 4));
    $db->insert('usuario', array('nome' => 'Paulo Quintana', 'email' => 'paulo@sacta.com', 'senha' => 'senhadopaulo', 'rg' => '1231231231', 'curso' => 'Engenhria de Telecomunicações', 'instituicao' => 'Unipampa', 'pagamento' => 'naopago', 'impresso' => 0, 'codigo_barras' => 84234, 'id_tipo_usuario' => 2));
    $db->insert('usuario', array('nome' => 'José Pereira', 'email' => 'jose@sacta.com', 'senha' => 'jose', 'rg' => '444343444', 'curso' => 'Ciência da Computação', 'instituicao' => 'Unipampa', 'pagamento' => 'naopago', 'impresso' => 0, 'codigo_barras' => 28759, 'id_tipo_usuario' => 1));
    
    $db->insert('palestra', array('nome_palestra' => 'Github', 'nome_palestrante' => 'João Neto', 'instituicao' => 'imasters', 'hora_inicio_prevista' => '2012-11-03 13:30:00', 'hora_fim_prevista' => '2012-11-03 15:30:00', 'hora_inicio' => '2012-11-03 13:34:32', 'hora_fim' => '2012-11-03 15:17:23', 'sala' => 101));
    $db->insert('palestra', array('nome_palestra' => 'Redmine', 'nome_palestrante' => 'João Filho', 'instituicao' => 'Redmine', 'hora_inicio_prevista' => '2012-11-03 16:00:00', 'hora_fim_prevista' => '2012-11-03 18:00:00', 'hora_inicio' => '2012-11-03 16:12:12', 'hora_fim' => '2012-11-03 18:29:31', 'sala' => 101));
    $db->insert('palestra', array('nome_palestra' => 'Netbeans', 'nome_palestrante' => 'João Pai', 'instituicao' => 'Oracle', 'hora_inicio_prevista' => '2012-11-03 18:30:00', 'hora_fim_prevista' => '2012-11-03 20:30:00', 'hora_inicio' => '2012-11-03 18:31:43', 'hora_fim' => '2012-11-03 20:33:12', 'sala' => 101));
    
    $db->insert('sessao', array('id_usuario' => 2, 'id_palestra' => 1, 'hora_entrada' => '2012-11-03 13:34:55', 'hora_saida' => '2012-11-03 15:17:23'));
    $db->insert('sessao', array('id_usuario' => 3, 'id_palestra' => 1, 'hora_entrada' => '2012-11-03 13:34:59', 'hora_saida' => '2012-11-03 15:17:30'));
    $db->insert('sessao', array('id_usuario' => 4, 'id_palestra' => 1, 'hora_entrada' => '2012-11-03 13:34:43', 'hora_saida' => '2012-11-03 15:17:38'));
    
    $db->insert('permissao', array('id_usuario' => 5, 'id_palestra' => 1));
    $db->insert('permissao', array('id_usuario' => 5, 'id_palestra' => 2));
    $db->insert('permissao', array('id_usuario' => 5, 'id_palestra' => 3));
    $db->insert('permissao', array('id_usuario' => 1, 'id_palestra' => 1));
    $db->insert('permissao', array('id_usuario' => 1, 'id_palestra' => 2));
    $db->insert('permissao', array('id_usuario' => 1, 'id_palestra' => 3));
    $db->insert('permissao', array('id_usuario' => 6, 'id_palestra' => 1));
    $db->insert('permissao', array('id_usuario' => 6, 'id_palestra' => 2));
    $db->insert('permissao', array('id_usuario' => 6, 'id_palestra' => 3));
    
    $db->insert('forma_pagamento', array('descricao' => 'Dinheiro'));
    $db->insert('forma_pagamento', array('descricao' => 'Cheque'));
    $db->insert('forma_pagamento', array('descricao' => 'Cartão de Crédito'));
    
endif;

if (APPLICATION_ENV == 'staging' || APPLICATION_ENV == 'production'):

    
    
endif;
