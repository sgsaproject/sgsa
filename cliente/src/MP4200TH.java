
import com.sun.jna.Native;
import java.io.IOException;
import org.apache.log4j.Logger;

/**
 *
 * @author thiago
 */
public class MP4200TH extends Printer {
    
    private Mp2032 lib;
    public static final int GUILHOTINA_MODO_TOTAL = 1;
    public static final int GUILHOTINA_MODO_PARCIAL = 0;
    public static final int MP_20_TH = 0;
    public static final int MP_2000_CI = 0;
    public static final int MP_2000_TH = 0;
    public static final int MP_20_MI = 1;
    public static final int MP_20_CI = 1;
    public static final int MP_20_S = 1;
    public static final int BLOCOS_TERMICOS = 2;
    public static final int BLOCOS_112MM = 3;
    public static final int THERMALKIOSK = 4;
    public static final int MP_4000_TH = 5;
    public static final int MP_4200_TH = 7;
    public static Logger logger = Logger.getLogger(MP4200TH.class);
    
    public MP4200TH() {
    }
    
    public void iniciaPorta(String porta) throws IOException {
        if (this.debug == false) {
            lib = (Mp2032) Native.loadLibrary("mp2032", Mp2032.class);
            int iniciaPorta = lib.IniciaPorta(porta);
            if (iniciaPorta == 0) {
                logger.fatal("Problemas ao abrir a porta de comunicação!");
                throw new IOException("Problemas ao abrir a porta de comunicação!");
            }
        } else {
            logger.info("Iniciando porta...");
        }
    }
    
    public void fechaPorta() throws IOException {
        if (this.debug == false) {
            int fechaPorta = lib.FechaPorta();
            if (fechaPorta == 0) {
                logger.fatal("Erro ao fechar a porta de comunicação!");
                throw new IOException("Erro ao fechar a porta de comunicação!");
            }
        } else {
            logger.info("Fechando porta...");
        }
    }
    
    public void configuraModeloImpressora(int printModel) throws IOException {
        if (this.debug == false) {
            int configModel = lib.ConfiguraModeloImpressora(printModel);
            if (configModel == -2) {
                logger.fatal("Parâmetro Inválido!");
                throw new IOException("Parâmetro Inválido!");
            }
        } else {
            logger.info("Configurando modelo impressora: " + printModel);
        }
        
    }
    
    public void abrirGaveta() throws IOException {
        if (this.debug == false) {
            String abreGaveta = (char) 27 + "" + (char) 118 + "" + (char) 140; // Abre gaveta
            int comantoTx = lib.ComandoTX(abreGaveta, abreGaveta.length());
            if (comantoTx == 0) {
                logger.fatal("Erro na comunicação!");
                throw new IOException("Erro na comunicação!");
            }
        } else {
            logger.info("Abrindo gaveta");
        }
    }
    
    public void acionaGuilhotina(int modo) throws IOException {
        int acionaGuilhotina = lib.AcionaGuilhotina(modo);
        if (acionaGuilhotina == 0) {
            logger.fatal("Erro na comunicação!");
            throw new IOException("Erro na comunicação!");
        } else if (acionaGuilhotina == -2) {
            logger.fatal("Parâmetro Inválido!");
            throw new IOException("Parâmetro Inválido!");
        }
    }
    
    public void acionaGuilhotinaModoTotal() throws IOException {
        if (this.debug == false) {
            this.acionaGuilhotina(GUILHOTINA_MODO_TOTAL);
        } else {
            logger.info("Acionando guilhotina modo total...");
        }
    }
    
    public void acionaGuilhotinaModoParcial() throws IOException {
        if (this.debug == false) {
            this.acionaGuilhotina(GUILHOTINA_MODO_PARCIAL);
        } else {
            logger.info("Adicionando guilhotina modo parcial...");
        }
    }
    
    public Mp2032 getLib() {
        return lib;
    }
    
    public void setLib(Mp2032 lib) {
        this.lib = lib;
    }
    
    @Override
    public void imprimir(String texto) throws IOException {
        if (this.debug == false) {
            
            int bematechTx = lib.BematechTX(texto);
            if (bematechTx == 0) {
                logger.fatal("Erro na comunicação!");
                throw new IOException("Erro na comunicação!");
            }
            this.acionaGuilhotinaModoTotal();
            this.fechaPorta();
        } else {
            logger.info("Imprimindo na impressora: " + this.getClass().getName());
            logger.info(texto);
        }
    }
    
    @Override
    public boolean conectada() {
        if (this.debug == true) {
            return this.conectada;
        }
        //verificar se impressora esta conectada aqui
        return true;
    }
}
