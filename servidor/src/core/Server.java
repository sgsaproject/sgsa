package core;

import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.Properties;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author thiago
 */
public class Server {

    private int port;
    private ServerSocket server;
    private Clients clients;
    private static Properties config;

    public Server() {
        clients = new Clients();
        this.port = Integer.parseInt(config.getProperty("port"));
    }

    public void init() {
        try {
            server = new ServerSocket(port);
            System.out.println("Servidor iniciado!");
            while (true) {
                System.out.println("Escutando conexões na porta " + port + "...");
                Socket clientSocket = server.accept();
                String ipClient = clientSocket.getInetAddress().getHostAddress();
                String ipSGSA = config.getProperty("sgsa.ip");
                int id = 1; // mudar pro id do cliente
                if (ipClient.equalsIgnoreCase(ipSGSA)) {
                    SGSA sgsa = new SGSA(clientSocket);
                    String text = sgsa.readText();
                    this.sendText(text, id);
                } else {
                    Client client = new Client(clientSocket);
                    client.start();
                    clients.add(client);
                }
            }
        } catch (IOException ex) {
            Logger.getLogger(Server.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    /**
     * Método que retorna a configuração
     *
     * @return config
     */
    public static Properties getConfig() {
        return config;
    }

    /**
     * Metodo que retorna a propriedade a partir de uma determinada chave.
     *
     * @param key
     * @return
     */
    public static String getProperty(String key) {
        return config.getProperty(key);
    }

    /**
     * Método que altera o valor de uma propriedade de uma dererminada chave.
     *
     * @param key
     * @param value
     */
    public static void setProperty(String key, String value) {
        config.setProperty(key, value);
    }

    /**
     * Método estático que lê o arquivo de configuração
     */
    public static void readConfig() {
        config = new Properties();
        FileReader fr;
        try {
            fr = new FileReader("config.prop");
            config.load(fr);
        } catch (FileNotFoundException ex) {
            ex.printStackTrace();
        } catch (IOException ex) {
            ex.printStackTrace();
        }
    }

    /**
     * Metodo estático que grava a configuração no arquivo.
     */
    public static void writeConfig() {
        try {
            FileWriter fw = new FileWriter("config.prop");
            config.store(fw, "");
        } catch (FileNotFoundException ex) {
            ex.printStackTrace();
        } catch (IOException ex) {
            ex.printStackTrace();
        }
    }

    private void sendText(String text, int id) {
        clients.getClientById(id).sendText(text);
    }
}
