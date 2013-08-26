import com.sun.jna.Library;
import com.sun.jna.win32.StdCallLibrary;

/**
 *
 * @author thiago
 */
public interface Mp2032 extends Library {

    /**
     * Esta função aciona a guilhotina, contando o papel em modo parcial ou
     * total.
     *
     * 0 (zero) : Modo Parcial (Parcial Cut). 1 (um) : Modo Total (Full Cut).
     *
     * ' Exemplo em Visual Basic iRetorno = AcionaGuilhotina(1) // Exemplo em
     * Delphi iRetorno := AcionaGuilhotina(1);
     *
     * Observação: O modo de acionamento parcial não deve ser usado nos Blocos
     * Impressores que possuirem PRESENTER.
     *
     * @param modo 0 (zero) : Modo Parcial (Parcial Cut), 1 (um) : Modo Total
     * (Full Cut).
     * @return O retorno desta função é dado através de um valor inteiro, onde
     * se o retorno for: 0 (zero) : Erro de Comunicação. 1 (um) : OK. -2 (menos
     * dois) : Parâmetro Inválido.
     */
    public int AcionaGuilhotina(int modo);

    /**
     * Seleciona a largura da bitola do papel da impressora.
     *
     * Parâmetro: iWidth: Variável do tipo INTEIRA, indicando a bitola do papel
     * em milímetros. Podendo ser: 48, 58, 76, 80 ou 112.
     *
     * Exemplo: ' Exemplo em Visual Basic – Seleciona bitola para 72 mm.
     * iRetorno = AjustaLarguraPapel(76) // Exemplo em Delphi iRetorno :=
     * AjustaLarguraPapel(76);
     *
     * Observação: A largura default utilizada pela DLL é de 48 mm, caso não se
     * configure uma nova largura, a impressão do bitmap será limitada a esse
     * valor.
     *
     * @param largura Parâmetro: iWidth: Variável do tipo INTEIRA, indicando a
     * bitola do papel em milímetros. Podendo ser: 48, 58, 76, 80 ou 112.
     * @return O retorno desta função é dado através de um valor inteiro, onde
     * se o retorno for: 0 (zero) : Erro de Comunicação. 1 (um) : OK. -4 (menos
     * quatro) : Parâmetro inválido.
     */
    public int AjustaLarguraPapel(int largura);

    /**
     * Esta função permite autenticar documentos com uma maior facilidade, sem a
     * necessidade do aplicativo enviar os comandos de autenticação para a
     * impressora. Basta passar o texto que deseja autenticar e o tempo de
     * espera, definido em milissegundos.
     *
     * Parâmetros: Texto: STRING que será usada na autenticação. Tempo: INTEIRO
     * com o tempo de espera.
     *
     * Modo de usar: AutenticaDoc( "Texto a ser impresso", 5000 ) onde: 5000 = 5
     * segundos de espera para a inserção do documento
     *
     * Exemplo: ' Exemplo em Visual Basic iRetorno = AutenticaDoc("Texto a ser
     * Autenticado", 5000) // Exemplo em Delphi cTexto := 'Texto a ser
     * Autenticado'; iRetorno := AutenticaDoc( pchar( cTexto ), 5000);
     *
     * @param texto Texto: STRING que será usada na autenticação.
     * @param tempo Tempo: INTEIRO com o tempo de espera.
     * @return O retorno desta função é dado através de um valor inteiro, onde
     * se o retorno for: 1 (um) : Sucesso. A função foi executada sem problemas.
     * 0 (zero) : Time-Out. O documento não foi inserido no tempo determinado.
     */
    public int AutenticaDoc(String texto, int tempo);

    /**
     * Esta função é utilizada na impressão de textos, enviando um conjunto com
     * várias linhas.
     *
     * Parâmetro: Texto: STRING com o texto a ser impresso.
     *
     * Exemplo: ' Exemplo em Visual Basic sTexto = "Total bruto: 12.500,00" +
     * chr( 10 ) sTexto = sTexto + "Total líquido: 9.600,00" + chr( 10 )
     * iRetorno = BematechTX( sTexto ) // Exemplo em Delphi sTexto := 'Total
     * bruto: 12.500,00' + #10; * sTexto := sTexto + 'Total líquido: 9.600,00' +
     * #10; * iRetorno := BematechTX( pchar( sTexto ) );
     *
     * @param texto STRING com o texto a ser impresso.
     * @return O retorno desta função é dado através de um valor inteiro, onde
     * se o retorno for: 1 (um) : Sucesso. A função foi executada sem problemas.
     * 0 (zero) : Erro na comunicação.
     */
    public int BematechTX(String texto);

    /**
     * Esta função tem por objetivo imprimir o caracter gráfico criado.
     *
     * Exemplo: ' Exemplo em Visual Basic ' DESENHO ' 1 2 3 4 5 6 7 8 9 ' bit 7
     * = 128 * * ' bit 6 = 064 * * * ' bit 5 = 032 * * * * ' bit 4 = 016 * * * *
     * * ' bit 3 = 008 * * * * * * ' bit 2 = 004 * * * * * * * ' bit 1 = 002 * *
     * * * * * * * ' bit 0 = 001 * * * * * * * * * ' Comando que habilita o modo
     * grafico com 9 pinos (9 colunas) sBuffer = Chr(27) + Chr(94) + Chr(18) +
     * Chr(0) iRetorno = ComandoTX(sBuffer, 4) ' Sequencia de bytes para a
     * montagem do desenho acima sBuffer = Chr(255) + Chr(0) + Chr(0) + Chr(0) +
     * _ Chr(127) + Chr(0) + Chr(0) + Chr(0) + _ Chr(63) + Chr(0) + Chr(0) +
     * Chr(0) + _ Chr(31) + Chr(0) + Chr(0) + Chr(0) + _ Chr(15) + Chr(0) +
     * Chr(0) + Chr(0) + _ Chr(7) + Chr(0) + Chr(0) + Chr(0) + _ Chr(3) + Chr(0)
     * + Chr(0) + Chr(0) + _ Chr(1) + Chr(0) + Chr(0) + Chr(0) + _ Chr(255) +
     * Chr(0) + Chr(0) + Chr(0) ' Descarrega o buffer na impressora. sBuffer =
     * sBuffer + Chr(13) + Chr(10) ' Função CaracterGrafico. iRetorno =
     * CaracterGrafico(sBuffer, Len(sBuffer))
     *
     * // Exemplo em Delphi { DESENHO 1 2 3 4 5 6 7 8 9 bit 7 = 128 * * bit 6 =
     * 064 * * * bit 5 = 032 * * * * bit 4 = 016 * * * * * bit 3 = 008 * * * * *
     * * bit 2 = 004 * * * * * * * bit 1 = 002 * * * * * * * * bit 0 = 001 * * *
     * * * * * * * } begin // Comando que habilita o modo grafico com 9 pinos (9
     * colunas) cmd := chr( 27 ) + chr( 94 ) + chr( 18 ) + chr( 0 ); comando :=
     * ComandoTX( cmd, Length( cmd ) ); // Sequencia de bytes para a montagem do
     * desenho acima cmd := chr(255) + chr(000) + chr(000) + chr(000) + chr(127)
     * + chr(000) + chr(000) + chr(000) + chr(063) + chr(000) + chr(000) +
     * chr(000) + chr(031) + chr(000) + chr(000) + chr(000) + chr(015) +
     * chr(000) + chr(000) + chr(000) + chr(007) + chr(000) + chr(000) +
     * chr(000) + chr(003) + chr(000) + chr(000) + chr(000) + chr(001) +
     * chr(000) + chr(000) + chr(000) + chr(255) + chr(000) + chr(000) +
     * chr(000); cmd := cmd + #13 + #10; // Função CaracterGrafico comando :=
     * CaracterGrafico( cmd, length( cmd ) ); end;
     *
     * @param texto
     * @param lenght
     * @return O retorno desta função é dado através de um valor inteiro, onde
     * se o retorno for: 1 (um) : Sucesso. A função foi executada sem problemas.
     * 0 (zero) : Erro ao fechar a porta de comunicação.
     */
    public int CaracterGrafico(String texto, int lenght);

    /**
     * Esta função é utilizada no envio de comandos para a impressora, como por
     * exemplo: comandos de Autenticação, comando para Acionamento de Gaveta,
     * comandos para Habilitar Tabelas de Caracteres, etc .
     *
     * Parâmetros: Comando: STRING com o comando que deseja executar. Tamanho do
     * Comando: INTEIRO com o tamanho do comando que será enviado.
     *
     * Exemplo: ' Exemplo em Visual Basic ' Comando para Acionar a Gaveta de
     * Dinheiro sComando = chr( 27 ) + chr( 118 ) + chr( 140 ) iRetorno =
     * ComandoTX( sComando, Len( sComando ) // Exemplo em Delphi // Comando para
     * Acionar a Gaveta de Dinheiro sComando := #27 + #118 + #140; iRetorno :=
     * ComandoTX( sComando, Length( sComando );
     *
     * @param comando Comando: STRING com o comando que deseja executar.
     * @param length Tamanho do Comando: INTEIRO com o tamanho do comando que
     * será enviado.
     * @return O retorno desta função é dado através de um valor inteiro, onde
     * se o retorno for: 1 (um) : Sucesso. A função foi executada sem problemas.
     * 0 (zero) : Erro na comunicação.
     */
    public int ComandoTX(String comando, int length);

    public int ConfiguraCodigoBarras(int altura, int largura, int posicao, int fonte, int margem);

    public int ConfiguraModeloImpressora(int modelo);

    public int IniciaPorta(String porta);
    
    public int FechaPorta();
    
    public int FormataTX(String texto, int tipoLetra, int italico, int sublinahdo, int expandido, int enfatizado);
}
