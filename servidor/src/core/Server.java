package core;

import java.io.BufferedReader;
import java.io.DataInputStream;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.Properties;
import org.apache.log4j.Logger;

/**
 *
 * @author thiago
 */
public class Server {

    private int port;
    private ServerSocket server;
    private Clients clients;
    private static Properties config;
    static Logger logger = Logger.getLogger(Server.class);

    public Server() {
        this.clients = new Clients();
        this.port = Integer.parseInt(config.getProperty("port"));
    }

    public void init() {
        try {
            server = new ServerSocket(port);
            logger.info("Servidor iniciado!");
            while (true) {
                logger.info("Escutando conexões na porta " + port + "...");
                Socket clientSocket = server.accept();
                BufferedReader d = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));
                String msgInicial = d.readLine();
                int id = 1; // mudar pro id do cliente
                if (msgInicial.equalsIgnoreCase("SGSA:PRINT")) {
                    SGSA sgsa = new SGSA(clientSocket);
                    String text = sgsa.readText();
                    logger.info("Mensagem recebida de SGSA: " + text);
                    this.sendText(text, id);
                } else {
                    logger.info("Cliente de impressão conectado: " + msgInicial);
                    Client client = new Client(clientSocket, id);
                    //client.start();
                    this.clients.add(client);
                }
            }
        } catch (IOException ex) {
            logger.fatal(null, ex);
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
            logger.fatal(null, ex);
        } catch (IOException ex) {
            logger.fatal(null, ex);
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
            logger.fatal(null, ex);
        } catch (IOException ex) {
            logger.fatal(null, ex);
        }
    }

    private void sendText(String text, int id) {
        if (this.clients.getSize() == 0) {
            logger.warn("Não há clientes para impressão");
            return;
        }
        clients.getLast().sendText(text);
    }
}
