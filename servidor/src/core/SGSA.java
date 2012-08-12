package core;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintStream;
import java.net.Socket;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author thiago
 */
public class SGSA {//extends Thread {

    private Socket socket;
    private BufferedReader in;
    private PrintStream out;

    public SGSA(Socket socket) {
        try {
            this.socket = socket;
            this.in = new BufferedReader(new InputStreamReader(socket.getInputStream()));
            this.out = new PrintStream(socket.getOutputStream());
        } catch (IOException ex) {
            Logger.getLogger(SGSA.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    public String readText() {
        try {
            String server = "";
            while (in.readLine() != null) {
                server += in.readLine() + "\n";
            }
            return server;
        } catch (IOException ex) {
            Logger.getLogger(SGSA.class.getName()).log(Level.SEVERE, null, ex);
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
