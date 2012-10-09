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

2) Faca o download da ferramenta `TortoiseGit`_ para o seu computador, atraves da pagina `http://code.google.com/p/tortoisegit/wiki/Download`_, a fim de clonar o repositorio do projeto em seu computador, e instale ela em seu computador executando todos os passos.

3) Procure o diretorio de instalacao do Xampp, e acesse a pasta 'xampp/htdocs' para colocar ali o clone da aplicacao no Repositorio. Clique com o botao direito no diretorio 'htdocs' e selecione a opcao 'Git Clone...'. Informe o caminho do repositorio (https://github.com/sgsaproject/sgsa.git) no campo URL confirme. Apos terminado o download e construido o clone do repositorio, clique com o botao direito sobre a pasta do projeto para acessar o menu de opcoes, selecione a opcao 'GitHub' e clique em 'Switch/Checkout...', Altere o Branch para 'v1.0' e confirme.

4) Entre o no diretorio do projeto, e acesse o diretorio 'application/configs' para ajustar algumas configuracoes. duplique o arquivo 'application.ini.dist', mantendo o mesmo nome, e remova as extensao '.dist'. Acesse o arquivo e mude o usuario ou senha do banco de dados se tiver sido cadastrado um usuario ou senha diferentes para o usuario root do MySql. Caso o usuario 'root' nao tenha sido alterado no banco de dados, mantenha o arquivo com as configuracoes encontradas. 


Ubuntu Linux
================================

.. Windows: #Windows
.. Ubuntu Linux: #Ubuntu Linux

.. _Xampp: http://www.apachefriends.org/pt_br/xampp.html
.. _http://www.apachefriends.org/pt_br/xampp-windows.html#2287: http://www.apachefriends.org/pt_br/xampp-windows.html#2287

.. _TortoiseGit: http://code.google.com/p/tortoisegit/
.. _http://code.google.com/p/tortoisegit/wiki/Download: http://code.google.com/p/tortoisegit/wiki/Download
