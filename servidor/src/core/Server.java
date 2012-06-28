package core;

import java.io.IOException;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author thiago
 */
public class Server {

    private final int port = 5588;
    private ServerSocket server;
    private Clients clients;

    public Server() {
        clients = new Clients();
    }

    public void init() {
        try {
            server = new ServerSocket(port);
            System.out.println("Servidor iniciado!");
            while (true) {
                System.out.println("Escutando conexões na porta " + port + "...");
                Socket clientSocket = server.accept();
                Client client = new Client(clientSocket);
                client.start();
                clients.add(client);
            }
        } catch (IOException ex) {
            Logger.getLogger(Server.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
}
