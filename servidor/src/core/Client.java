package core;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.Socket;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author thiago
 */
public class Client extends Thread {

    private int identifier;
    private Socket clientSocket;
    private BufferedReader in;
    private BufferedReader out;

    public Client(Socket clientSocket) {
        try {
            this.clientSocket = clientSocket;
            this.in = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));
            //this.out = new PrintStream(clientSocket.getOutputStream());
        } catch (IOException ex) {
            Logger.getLogger(Client.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    @Override
    public void run() {
        //BufferedReader entrada = null;
        try {
            //entrada = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));
            //PrintStream saida = new PrintStream(conexaoCliente.getOutputStream());
            // aqui a cobra fuma!
            // lê o comando SERVER
            String server = in.readLine();
            System.out.println(server);
        } catch (IOException ex) {
            Logger.getLogger(Client.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    public synchronized int getIdentifier() {
        return identifier;
    }

    public synchronized void setIdentifier(int identifier) {
        this.identifier = identifier;
    }

    public synchronized Socket getClientSocket() {
        return clientSocket;
    }

    public synchronized void setClientSocket(Socket clientSocket) {
        this.clientSocket = clientSocket;
    }
    
    public synchronized BufferedReader getIn() {
        return this.in;
    }
    
    public synchronized void setIn(BufferedReader in) {
        this.in = in;
    }
    
    public synchronized BufferedReader getOut() {
        return this.out;
    }
    
    public synchronized void setOut(BufferedReader out) {
        this.out = out;
    }
}
