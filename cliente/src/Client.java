
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
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

        logger.info("Enviando id: " + identifier);
        ps.println("Client id: " + identifier);
        logger.info("Id " + identifier + " enviado");
        
        BufferedReader in = new BufferedReader(new InputStreamReader(is));
        while (true) {
            try {
                String text = "", line;
                while ((line = in.readLine()) != null) {
                    text += line + "\n";
                }
                logger.info("Mensagem recebida: " + text);
            } catch (IOException ex) {
                logger.fatal("", ex);
            }
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
