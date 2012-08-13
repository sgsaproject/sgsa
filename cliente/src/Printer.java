
import com.sun.jna.Native;
import org.apache.log4j.Logger;

/**
 *
 * @author thiago
 */
public class Printer {

    private Mp2032 lib;
    private String port;
    private int printModel;
    public static Logger logger = Logger.getLogger(Printer.class);

    public Printer(String port, int printerModel) {
        lib = (Mp2032) Native.loadLibrary("mp2032", Mp2032.class);
        this.port = port;
        this.printModel = printerModel;
    }

    public void print(String texto, boolean acionarGuilhotinha, boolean abrirGaveta) throws Exception {
        int iniciaPorta = lib.IniciaPorta(port);
        if (iniciaPorta == 0) {
            logger.fatal("Problemas ao abrir a porta de comunicação!");
            throw new Exception("Problemas ao abrir a porta de comunicação!");
        }

        int bematechTx = lib.BematechTX(texto);
        if (bematechTx == 0) {
            logger.fatal("Erro na comunicação!");
            throw new Exception("Erro na comunicação!");
        }

        if (acionarGuilhotinha) {
            int acionaGuilhotina = lib.AcionaGuilhotina(1);
            if (acionaGuilhotina == 0) {
                logger.fatal("Erro na comunicação!");
                throw new Exception("Erro na comunicação!");
            } else if (acionaGuilhotina == -2) {
                logger.fatal("Parâmetro Inválido!");
                throw new Exception("Parâmetro Inválido!");
            }
        }

        if (abrirGaveta) {
            String abreGaveta = (char) 27 + "" + (char) 118 + "" + (char) 140; // Abre gaveta
            int comantoTx = lib.ComandoTX(abreGaveta, abreGaveta.length());
            if (comantoTx == 0) {
                logger.fatal("Erro na comunicação!");
                throw new Exception("Erro na comunicação!");
            }
        }

        int fechaPorta = lib.FechaPorta();
        if (fechaPorta == 0) {
            logger.fatal("Erro ao fechar a porta de comunicação!");
            throw new Exception("Erro ao fechar a porta de comunicação!");
        }
    }

    public Mp2032 getLib() {
        return lib;
    }

    public void setLib(Mp2032 lib) {
        this.lib = lib;
    }

    public String getPort() {
        return port;
    }

    public void setPort(String port) {
        this.port = port;
    }

    public int getPrintModel() {
        return printModel;
    }

    public void setPrintModel(int printModel) {
        this.printModel = printModel;
    }
}
