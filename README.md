# Módulo de Impressão

O módulo de impressão tem como objetivo tornar possível a impressão de etiquetas e recibos a partir da aplicação web. O módulo de impressão é composto de um servidor e um cliente, ambos escrito em java e utilizam sockets para se comunicar. O servidor age como uma "ponte" da aplicação web para o cliente de impressão, ele recebe pedidos de impressão da aplicação web e repassa para um cliente disponível. O cliente de impressão trata de receber os pedidos de impressão vindos do servidor de impressão e imprime localmente na impressora disponível.