package core;

import java.io.BufferedReader;
import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.PrintStream;
import java.net.Socket;
import java.util.logging.Level;
import org.apache.log4j.Logger;

/**
 *
 * @author thiago
 */
public class Client extends Thread {

    private int identifier;
    private Socket clientSocket;
    private BufferedReader in;
    private PrintStream out;
    private DataInputStream inputStream;
    private DataOutputStream outputStream;
    
    private int suporte;
            
    static Logger logger = Logger.getLogger(Client.class);
    
    public static final int SUPORTE_RECIBO = 1;
    public static final int SUPORTE_ETIQUETA = 2;
    public static final int SUPORTE_RECIBO_E_ETIQUETA = 3;

    public Client(Socket clientSocket, int id) {
        try {
            this.identifier = id;
            this.clientSocket = clientSocket;
            //this.in = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));
            this.inputStream = new DataInputStream(this.clientSocket.getInputStream());
            this.outputStream = new DataOutputStream(this.clientSocket.getOutputStream());
            //this.out = new PrintStream(clientSocket.getOutputStream());
        } catch (IOException ex) {
            logger.fatal(null, ex);
        }
    }

    @Override
    public void run() {
        BufferedReader entrada = null;
        try {
            //entrada = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));
            //PrintStream saida = new PrintStream(conexaoCliente.getOutputStream());
            // aqui a cobra fuma!
            // lê o comando SERVER
            while (true) {
                String server = this.inputStream.readUTF();
                logger.info(server);
            }

        } catch (IOException ex) {
            logger.fatal(null, ex);
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

    public synchronized PrintStream getOut() {
        return this.out;
    }

    public synchronized void setOut(PrintStream out) {
        this.out = out;
    }

    public synchronized void sendText(String text) {
        logger.info(text);
        try {
            this.outputStream.writeUTF(text);
            this.outputStream.flush();
        } catch (IOException ex) {
            logger.fatal(null, ex);
        }

    }

    public int getSuporte() {
        return suporte;
    }

    public void setSuporte(int suporte) {
        this.suporte = suporte;
    }
    
}
