
import java.io.DataInputStream;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.io.PrintStream;
import java.net.ConnectException;
import java.net.SocketException;
import java.net.UnknownHostException;
import java.util.Properties;
import javax.print.PrintException;
import org.apache.log4j.Logger;

/**
 *
 * @author thiago
 */
public class Client {

    private int identifier;
    private Server server;
    public static Logger logger = Logger.getLogger(Client.class);
    private int tempo = 2;
    private OutputStream os = null;
    private InputStream is = null;
    private PrintStream ps = null;
    L42 l42;
    MP4200TH mp4200;
    String ip;
    private static Properties config;

    public Client(int identifier, String ip) {
        this.identifier = identifier;
        this.mp4200 = new MP4200TH();
        this.l42 = new L42();
        this.ip = ip;
    }

    private void sleep() {
        try {
            Thread.sleep(this.tempo * 1000);
        } catch (InterruptedException ex) {
            logger.fatal(null, ex);
        }
        if (this.tempo != 320) {
            this.tempo = this.tempo * 2;
        }

    }

    public void init() {

        this.l42.setDebugMode(true);
        this.l42.setConectada(true);
        this.mp4200.setDebugMode(true);
        this.mp4200.setConectada(true);

        this.conectar(this.ip);

        try {
            // get OutputStream from server to write streams
            os = this.server.getOutputStream();
            is = this.server.getInputStream();
        } catch (IOException ex) {
            logger.fatal("", ex);
        }

        ps = new PrintStream(os);
        //Fazer verificação das impressoras que estão disponíveis
        if (this.l42.conectada() && this.mp4200.conectada()) {
            ps.println("CLIENT:PRINTER:RECIBO_E_ETIQUETA");
            logger.info("Impressora de recibo e etiqueta conectada");
        } else if (this.l42.conectada()) {
            ps.println("CLIENT:PRINTER:ETIQUETA");
            logger.info("Impressora de etiqueta conectada");
        } else if (this.mp4200.conectada()) {
            ps.println("CLIENT:PRINTER:RECIBO");
            logger.info("Impressora de recibo conectada");
        }else {
            ps.println("CLIENT:PRINTER:NONE");
        }
        //printer = new Printer("COM3", 7);

        DataInputStream inputStream = new DataInputStream(this.is);
        try {
            String line;
            while (true) {

                line = inputStream.readUTF();
                logger.info("Mensagem recebida: " + line);
                if (line.equalsIgnoreCase("PRINT:RECIBO")) {
                    try {
                        this.mp4200.iniciaPorta(null);
                        this.mp4200.configuraModeloImpressora(MP4200TH.MP_4200_TH);
                        this.mp4200.imprimir(inputStream.readUTF());
                        this.mp4200.fechaPorta();
                    } catch (IOException ex) {
                        logger.fatal("Erro ao imprimir na impressora de recibo", ex);
                    }
                } else if (line.equalsIgnoreCase("PRINT:ETIQUETA")) {
                    try {
                        this.l42.imprimir(inputStream.readUTF());
                    } catch (IOException | PrintException ex) {
                        logger.fatal("Erro ao imprimir na impressora de etiqueta", ex);
                    }
                } else if (line.equalsIgnoreCase("ABRIR:GAVETA")) {
                    try {
                        this.mp4200.iniciaPorta(null);
                        this.mp4200.configuraModeloImpressora(MP4200TH.MP_4200_TH);
                        this.mp4200.abrirGaveta();
                        this.mp4200.fechaPorta();
                    } catch (IOException ex) {
                        logger.fatal("Erro ao abrir gaveta", ex);
                    }
                }

            }
        } catch (SocketException ex) {
            logger.fatal(ex.getMessage() + ": Tentando reconnectar em " + this.tempo + " segundos...");
            this.sleep();
            this.init();
        } catch (IOException ex) {
            logger.fatal("", ex);
        }
    }

    /**
     * @return the identifier
     */
    public int getIdentifier() {
        return identifier;
    }

    /**
     * @param identifier the identifier to set
     */
    public void setIdentifier(int identifier) {
        this.identifier = identifier;
    }

    public Server getServer() {
        return server;
    }

    public void setServer(Server server) {
        this.server = server;
    }

    private void conectar(String ip) {
        try {
            // initialize the conection with server
            logger.info("Conectando no servidor " + ip + "...");
            this.server = new Server();
        } catch (ConnectException ex) {
            logger.fatal(ex.getMessage() + ": Tentando reconnectar em " + this.tempo + " segundos...");
            this.sleep();
            this.conectar(ip);
        } catch (SocketException ex) {
            logger.fatal(ex.getMessage() + ": Tentando reconnectar em " + this.tempo + " segundos...");
            this.sleep();
            this.conectar(ip);
        } catch (UnknownHostException ex) {
            logger.fatal(null, ex);
        } catch (IOException ex) {
            logger.fatal(null, ex);
        }
    }
    
    /**
     * Método que retorna a configuração
     *
     * @return config
     */
    public static Properties getConfig() {
        return config;
    }

    /**
     * Metodo que retorna a propriedade a partir de uma determinada chave.
     *
     * @param key
     * @return
     */
    public static String getProperty(String key) {
        return config.getProperty(key);
    }

    /**
     * Método que altera o valor de uma propriedade de uma dererminada chave.
     *
     * @param key
     * @param value
     */
    public static void setProperty(String key, String value) {
        config.setProperty(key, value);
    }

    /**
     * Método estático que lê o arquivo de configuração
     */
    public static void readConfig() {
        config = new Properties();
        FileReader fr;
        try {
            fr = new FileReader("config.prop");
            config.load(fr);
        } catch (FileNotFoundException ex) {
            logger.fatal(null, ex);
        } catch (IOException ex) {
            logger.fatal(null, ex);
        }
    }

    /**
     * Metodo estático que grava a configuração no arquivo.
     */
    public static void writeConfig() {
        try {
            FileWriter fw = new FileWriter("config.prop");
            config.store(fw, "");
        } catch (FileNotFoundException ex) {
            logger.fatal(null, ex);
        } catch (IOException ex) {
            logger.fatal(null, ex);
        }
    }
}
