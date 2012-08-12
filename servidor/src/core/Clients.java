package core;

import java.util.ArrayList;

/**
 *
 * @author thiago
 */
public class Clients {

    private ArrayList<Client> clients;

    public Clients() {
        clients = new ArrayList<>();
    }

    /**
     * Metodo que adiciona um novo cliente que se conectou
     *
     * @param client
     * @return true caso foi adicionado com sucesso
     */
    public synchronized boolean add(Client client) {
        return clients.add(client);
    }

    /**
     * Metodo que remove um cliente da lista
     *
     * @param cliente
     * @return true caso foi removido com sucesso
     */
    public synchronized boolean remove(Client client) {
        return clients.remove(client);
    }

    /**
     * Metodo que retorna true caso o cliente esteja na lista
     *
     * @param client
     * @return true caso o nome esteja na lista
     */
    public synchronized boolean contains(Client client) {
        return clients.contains(client);
    }
    
    public synchronized Client getClientById(int id) {
        for (Client client : clients) {
            if (client.getId() == id) {
                return client;
            }
        }
        return null;
    }
}
