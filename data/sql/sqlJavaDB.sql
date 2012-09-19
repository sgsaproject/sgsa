
CREATE TABLE palestra (
  id_palestra INT NOT NULL,
  nome_palestra VARCHAR(150) ,
  nome_palestrante VARCHAR(100) ,
  instituicao VARCHAR(100) ,
  hora_inicio_prevista TIME ,
  hora_fim_prevista TIME ,
  hora_inicio TIME ,
  hora_fim TIME ,
  sala VARCHAR(30) ,
  PRIMARY KEY (id_palestra) );


CREATE TABLE tipo_usuario (
  id_tipo_usuario INT NOT NULL ,
  nome VARCHAR(30)  ,
  alias VARCHAR(30) ,
  PRIMARY KEY (id_tipo_usuario) );



CREATE TABLE usuario (
  id_usuario INT NOT NULL  ,
  nome VARCHAR(100),
  email VARCHAR(50) ,
  login VARCHAR(45) ,
  senha VARCHAR(45) ,
  id_tipo_usuario INT NOT NULL ,
  PRIMARY KEY (id_usuario) ,
  INDEX fk_usuario_tipo_usuario1 (id_tipo_usuario ASC) ,
  CONSTRAINT fk_usuario_tipo_usuario1
    FOREIGN KEY (id_tipo_usuario )
    REFERENCES tipo_usuario (id_tipo_usuario )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);



CREATE TABLE ouvinte (
  id_ouvinte INT NOT NULL  ,
  nome VARCHAR(100) ,
  rg VARCHAR(15) ,
  email VARCHAR(50) ,
  curso VARCHAR(50) ,
  instituicao VARCHAR(50)   ,
  pagamento VARCHAR(10)  DEFAULT 'naopago' ,
  impresso TINYINT(1)  DEFAULT 0 ,
  codigo_barras CHAR(6) NOT NULL ,
  PRIMARY KEY (id_ouvinte) ,
  UNIQUE INDEX un_cod_barras (codigo_barras ASC) );



CREATE TABLE sessao (
  id_sessao INT NOT NULL  ,
  id_ouvinte INT NOT NULL ,
  id_palestra INT NOT NULL ,
  hora_entrada TIME ,
  hora_saida TIME ,
  PRIMARY KEY (id_sessao) ,
  INDEX fk_sessao_ouvinte2 (id_ouvinte ASC) ,
  INDEX fk_sessao_palestra2 (id_palestra ASC) ,
  CONSTRAINT fk_sessao_ouvinte2
    FOREIGN KEY (id_ouvinte )
    REFERENCES ouvinte (id_ouvinte )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_sessao_palestra2
    FOREIGN KEY (id_palestra )
    REFERENCES palestra (id_palestra )
    ON DELETE CASCADE
    ON UPDATE NO ACTION);



CREATE TABLE permissao (
  id_permissao INT NOT NULL  ,
  id_usuario INT NOT NULL ,
  id_palestra INT NOT NULL ,
  PRIMARY KEY (id_permissao) ,
  INDEX fk_usuario_palestra_usuario1 (id_usuario ASC) ,
  INDEX fk_usuario_palestra_palestra1 (id_palestra ASC) ,
  CONSTRAINT fk_usuario_palestra_usuario1
    FOREIGN KEY (id_usuario );
    REFERENCES usuario (id_usuario );
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_usuario_palestra_palestra1
    FOREIGN KEY (id_palestra );
    REFERENCES palestra (id_palestra );
    ON DELETE CASCADE
    ON UPDATE NO ACTION)



INSERT INTO tipo_usuario (id_tipo_usuario, nome, alias) VALUES (1, 'Organizador', 'organizador');
INSERT INTO tipo_usuario (id_tipo_usuario, nome, alias) VALUES (2, 'Colaborador', 'colaborador');
INSERT INTO tipo_usuario (id_tipo_usuario, nome, alias) VALUES (3, 'Administrador', 'administrador');

INSERT INTO usuario (id_usuario, nome, email, login, senha, id_tipo_usuario) VALUES (1, 'Administrador', '', 'admin', 'admin', 3);
