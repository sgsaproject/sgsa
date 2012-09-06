
import com.sun.jna.Native;
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
        lib = (Mp2032) Native.loadLibrary("mp2032", Mp2032.class);
    }

    public void iniciaPorta(String porta) throws Exception {
        int iniciaPorta = lib.IniciaPorta(porta);
        if (iniciaPorta == 0) {
            logger.fatal("Problemas ao abrir a porta de comunicação!");
            throw new Exception("Problemas ao abrir a porta de comunicação!");
        }
    }

    public void fechaPorta() throws Exception {
        int fechaPorta = lib.FechaPorta();
        if (fechaPorta == 0) {
            logger.fatal("Erro ao fechar a porta de comunicação!");
            throw new Exception("Erro ao fechar a porta de comunicação!");
        }
    }

    public void configuraModeloImpressora(int printModel) throws Exception {
        int configModel = lib.ConfiguraModeloImpressora(printModel);
        if (configModel == -2) {
            logger.fatal("Parâmetro Inválido!");
            throw new Exception("Parâmetro Inválido!");
        }

    }

    public void abrirGaveta() throws Exception {
        String abreGaveta = (char) 27 + "" + (char) 118 + "" + (char) 140; // Abre gaveta
        int comantoTx = lib.ComandoTX(abreGaveta, abreGaveta.length());
        if (comantoTx == 0) {
            logger.fatal("Erro na comunicação!");
            throw new Exception("Erro na comunicação!");
        }
    }

    public void acionaGuilhotina(int modo) throws Exception {
        int acionaGuilhotina = lib.AcionaGuilhotina(modo);
        if (acionaGuilhotina == 0) {
            logger.fatal("Erro na comunicação!");
            throw new Exception("Erro na comunicação!");
        } else if (acionaGuilhotina == -2) {
            logger.fatal("Parâmetro Inválido!");
            throw new Exception("Parâmetro Inválido!");
        }
    }

    public void acionaGuilhotinaModoTotal() throws Exception {
        this.acionaGuilhotina(GUILHOTINA_MODO_TOTAL);
    }

    public void acionaGuilhotinaModoParcial() throws Exception {
        this.acionaGuilhotina(GUILHOTINA_MODO_PARCIAL);
    }

    public Mp2032 getLib() {
        return lib;
    }

    public void setLib(Mp2032 lib) {
        this.lib = lib;
    }

    @Override
    public void imprimir(String texto) throws Exception {
        int bematechTx = lib.BematechTX(texto);
        if (bematechTx == 0) {
            logger.fatal("Erro na comunicação!");
            throw new Exception("Erro na comunicação!");
        }
    }

    @Override
    public boolean conectada() {
        return true;
    }
}
