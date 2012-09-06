
import java.io.DataInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.io.PrintStream;
import java.net.UnknownHostException;
import org.apache.log4j.Logger;

/**
 *
 * @author thiago
 */
public class Client {

    private int identifier;
    private Server server;
    public static Logger logger = Logger.getLogger(Client.class);

    public Client(int identifier) {
        this.identifier = identifier;
    }

    public void init(String ip) {
        try {
            // initialize the conection with server
            logger.info("Conectando no servidor " + ip + "...");
            this.server = new Server(ip);
        } catch (UnknownHostException ex) {
            logger.fatal("", ex);
        } catch (IOException ex) {
            logger.fatal("", ex);
        }
        logger.info("Conectado");

        OutputStream os = null;
        InputStream is = null;
        PrintStream ps = null;

        try {
            // get OutputStream from server to write streams
            os = this.server.getOutputStream();
            is = this.server.getInputStream();
        } catch (IOException ex) {
            logger.fatal("", ex);
        }

        ps = new PrintStream(os);

        L42 l42 = new L42();
        MP4200TH mp4200 = new MP4200TH();
        
        //Fazer verificação das impressoras que estão disponíveis
        if(l42.conectada() && mp4200.conectada()){
            ps.println("CLIENT:PRINTER:RECIBO_E_ETIQUETA");
        }else if(l42.conectada()){
            ps.println("CLIENT:PRINTER:ETIQUETA");
        }else if(mp4200.conectada()){
            ps.println("CLIENT:PRINTER:RECIBO");
        }
        //printer = new Printer("COM3", 7);

        DataInputStream inputStream = new DataInputStream(is);
        try {
            String line;
            while (true) {
                line = inputStream.readUTF();
                logger.info("Mensagem recebida: " + line);
                try {
                    //printer.print(line, false, false);
                } catch (Exception ex) {
                    logger.fatal(ex);
                }
            }
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
}
