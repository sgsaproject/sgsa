package core;

import java.io.BufferedReader;
import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintStream;
import java.net.Socket;
import org.apache.log4j.Logger;

/**
 *
 * @author thiago
 */
public class SGSA {//extends Thread {

    private Socket socket;
    private BufferedReader in;
    private PrintStream out;
    private DataInputStream inputStream;
    private DataOutputStream outputStream;
    static Logger logger = Logger.getLogger(Server.class);

    public SGSA(Socket socket) {
        try {
            this.socket = socket;
            this.in = new BufferedReader(new InputStreamReader(socket.getInputStream()));
            //this.out = new PrintStream(socket.getOutputStream());

            //this.inputStream = new DataInputStream(this.socket.getInputStream());
            this.outputStream = new DataOutputStream(this.socket.getOutputStream());
        } catch (IOException ex) {
            logger.fatal(null, ex);
        }
    }

    public String readText() {
        try {
            String server = "", line;
            while ((line = in.readLine()) != null) {
                server += line + "\n";
            }
            return server;
            //return this.inputStream.readUTF();
        } catch (IOException ex) {
            logger.fatal(null, ex);
        }
        return null;
    }

    /*@Override
     public void run() {
     //BufferedReader entrada = null;
     try {
     //entrada = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));
     //PrintStream saida = new PrintStream(conexaoCliente.getOutputStream());
     // aqui a cobra fuma!
     // lê o comando SERVER
     String server = "";
     while (in.readLine() != null) {
     server += in.readLine() + "\n";
     }
     System.out.println(server);
     } catch (IOException ex) {
     Logger.getLogger(Client.class.getName()).log(Level.SEVERE, null, ex);
     }
     }*/
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
    public PrintStream getOut() {
        return out;
    }

    /**
     * @param out the out to set
     */
    public void setOut(PrintStream out) {
        this.out = out;
    }
}
