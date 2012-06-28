
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.io.PrintStream;
import java.net.UnknownHostException;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author thiago
 */
public class Client {

    private int identifier;
    private Server server;

    public Client(int identifier, String ip) {
        this.identifier = identifier;
        try {
            // initialize the conection with server
            this.server = new Server(ip);
        } catch (UnknownHostException ex) {
            Logger.getLogger(Client.class.getName()).log(Level.SEVERE, null, ex);
        } catch (IOException ex) {
            Logger.getLogger(Client.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    
    public void init() {
        OutputStream os = null;
        InputStream is = null;
        PrintStream ps = null;
        
        try {
            // get OutputStream from server to write streams
            os = this.server.getOutputStream();
            is = this.server.getInputStream();
        } catch (IOException ex) {
            Logger.getLogger(Client.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        ps = new PrintStream(os);
        
        ps.println("Client id: " + identifier);
        
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
