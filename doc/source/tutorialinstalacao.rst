================================
Tutorial de Instalação
================================

Aqui apresentamos como instalar o SGSA:

* em `Windows`_
* em `Ubuntu Linux`_

Windows
================================

Para instalar a aplicacao SGSA em um Windows SO, primeiramente e necessario instalar algumas ferramentas em seu computador, para preparar um ambiente que suporte a aplicacao.

1) Faca o download da ferramenta `Xampp`_ para o seu computador, atraves da pagina `http://www.apachefriends.org/pt_br/xampp-windows.html#2287`_, e instale-a em sua maquina.

- Se baixar o Xampp em um arquivo compactado, simplesmente descompacte ele em seu disco rigido ou aonde preferir.
- Se baixar o instalador do Xampp, apenas execute-o e siga os passos ate instalar a ferramenta em seu computador.

Apos instalado o Xampp na sua maquina, um painel de controle da ferramenta sera aberto, com algumas funcionalidades de gerenciamento dos servicos disponiveis. Peca para iniciar o Apache e o MySql clicando no botao 'Start'.

2) Faca o download do framework `Zend Framework 1`_ versao full para o computador, atraves da pagina `http://framework.zend.com/downloads/latest`_, para integrar a tecnologia com o php do Xampp, e instale no local desejado (sugestao: instale dentro do diretorio do Xampp). Acesse o diretorio do framework e entre na pasta 'extras/library/' e copie o library 'ZendX' para a pasta 'library/' dentro do diretorio do framework.

3) Acesse o arquivo 'php.ini' que pode ser encrontrado dentro do Xampp na pasta 'etc/', para integrar o Zend com o php. procure o atributo 'include_path' dentro do arquivo, e remova o caracter ';' no inicio da linha logo apos a referencia ao 'Windows'. acrescente o caracter ':' no final do caminho indicado pela string, e informe o caminho para a pasta 'library/' da instalacao do Zend Framework realizada no passo anterior.

4) Faca o download da ferramenta `TortoiseGit`_ para o seu computador, atraves da pagina `http://code.google.com/p/tortoisegit/wiki/Download`_, a fim de clonar o repositorio do projeto em seu computador, e instale ela em seu computador executando todos os passos.

5) Procure o diretorio de instalacao do Xampp, e acesse a pasta 'xampp/htdocs/' para colocar ali o clone da aplicacao no Repositorio. Clique com o botao direito no diretorio 'htdocs' e selecione a opcao 'Git Clone...'. Informe o caminho do repositorio (https://github.com/sgsaproject/sgsa.git) no campo URL confirme. Apos terminado o download e construido o clone do repositorio, clique com o botao direito sobre a pasta do projeto para acessar o menu de opcoes, selecione a opcao 'TortoiseGit' e clique em 'Switch/Checkout...', Altere o Branch para 'v1.0' e confirme.

6) Abra o prompt de Comando e procure o diretorio de instalacao do Xampp. Acesse o diretorio do projeto na pasta htdocs, e entre na pasta 'script' para executar o comando 'php setup-db.php', e configurar o ambiente do banco de dados, criar as tabelas e inserir alguns dados.

7) Retorne ao diretorio do projeto, e acesse a pasta 'application/configs/' para ajustar algumas configuracoes. duplique o arquivo 'application.ini.dist', mantendo o mesmo nome, e remova as extensao '.dist'. Acesse o arquivo e mude o usuario ou senha do banco de dados se deseja cadastrador um usuario ou senha diferentes para o banco de dados do MySql. Caso seja adotado o usuario 'root' padrao do MySql, mantenha o arquivo com as configuracoes encontradas. 

8) Acesse a pagina do projeto instalado atraves do link "http://localhost/sgsa/public".

Ubuntu Linux
================================

.. Windows: #Windows
.. Ubuntu Linux: #Ubuntu Linux

.. _Xampp: http://www.apachefriends.org/pt_br/xampp.html
.. _http://www.apachefriends.org/pt_br/xampp-windows.html#2287: http://www.apachefriends.org/pt_br/xampp-windows.html#2287

.. _Zend Framework 1: http://framework.zend.com
.. _http://framework.zend.com/downloads/latest: http://framework.zend.com/downloads/latest

.. _TortoiseGit: http://code.google.com/p/tortoisegit/
.. _http://code.google.com/p/tortoisegit/wiki/Download: http://code.google.com/p/tortoisegit/wiki/Download
