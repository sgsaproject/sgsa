package core;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.Socket;
import org.apache.log4j.Logger;

/**
 *
 * @author thiago
 */
public class SGSA {

    private Socket socket;
    private BufferedReader in;
    private BufferedWriter out;
    private DataInputStream inputStream;
    private DataOutputStream outputStream;
    static Logger logger = Logger.getLogger(Server.class);

    public SGSA(Socket socket) {
        try {
            this.socket = socket;
            this.in = new BufferedReader(new InputStreamReader(this.socket.getInputStream()));
            this.out = new BufferedWriter(new OutputStreamWriter(this.socket.getOutputStream()));

            this.inputStream = new DataInputStream(this.socket.getInputStream());
            this.outputStream = new DataOutputStream(this.socket.getOutputStream());
        } catch (IOException ex) {
            logger.fatal(null, ex);
        }
    }

    public String readText() {
        try {
            String server = "", line;
            while ((line = in.readLine()) != null) {
                System.out.println(line);
                server += line + "\n";
            }
            return server;
            //return this.in.readLine();
        } catch (IOException ex) {
            logger.fatal(null, ex);
        }
        return null;
    }
    
    public synchronized void sendText(String text) {
        logger.info("Enviado resposta para o servidor: " + text);
        try {
            this.outputStream.writeUTF(text);
            this.outputStream.flush();
        } catch (IOException ex) {
            logger.fatal(null, ex);
        }
    }

    /**
     * @return the socket
     */
    public Socket getSocket() {
        return socket;
    }

    /**
     * @param socket the socket to set
     */
    public void setSocket(Socket socket) {
        this.socket = socket;
    }

    /**
     * @return the in
     */
    public BufferedReader getIn() {
        return in;
    }

    /**
     * @param in the in to set
     */
    public void setIn(BufferedReader in) {
        this.in = in;
    }

    /**
     * @return the out
     */
    public BufferedWriter getOut() {
        return out;
    }

    /**
     * @param out the out to set
     */
    public void setOut(BufferedWriter out) {
        this.out = out;
    }
}
