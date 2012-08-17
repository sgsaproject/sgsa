package core;

import java.net.Socket;
import java.util.ArrayList;
import org.apache.log4j.Logger;

/**
 *
 * @author thiago
 */
public class Clients {

    private ArrayList<Client> clients;
    private static int idClient = 1;
    
    static Logger logger = Logger.getLogger(Clients.class);

    public Clients() {
        this.clients = new ArrayList<>();
    }

    /**
     * Metodo que adiciona um novo cliente que se conectou
     *
     * @param client
     * @return true caso foi adicionado com sucesso
     */
    public synchronized boolean add(Client client) {
        logger.info("Adicionado cliente: "+client.getClientSocket().getInetAddress().toString());
        return this.clients.add(client);
    }

    /**
     * Metodo que remove um cliente da lista
     *
     * @param cliente
     * @return true caso foi removido com sucesso
     */
    public synchronized boolean remove(Client client) {
        return this.clients.remove(client);
    }

    /**
     * Metodo que retorna true caso o cliente esteja na lista
     *
     * @param client
     * @return true caso o nome esteja na lista
     */
    public synchronized boolean contains(Client client) {
        return this.clients.contains(client);
    }
    
    public synchronized Client getClientById(int id) {
        for (Client client : this.clients) {
            if (client.getId() == id) {
                return client;
            }
        }
        return null;
    }
    
    public synchronized Client getFirst() {
        return this.clients.get(0);
    }
    public synchronized Client getLast() {
        return this.clients.get(this.clients.size() - 1);
    }
    
    public int getSize() {
        return this.clients.size();
    }
    
    public Client getClientBySuporte(int tipoImpressora){
        for (Client client : this.clients) {
            if (client.getSuporte() == tipoImpressora) {
                return client;
            }
        }
        return null;
    }
    
    public static Client create(Socket clientSocket){
        logger.info("Criando cliente com id: "+Clients.idClient);
        Client c = new Client(clientSocket, Clients.idClient );
        Clients.idClient++;
        return c;
    }
}
