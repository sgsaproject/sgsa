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
                String msgInicialArray[] = msgInicial.split(":");
                int id = 1; // mudar pro id do cliente
                if (msgInicial.contains("SGSA:PRINT")) {
                    if(msgInicialArray.length != 3){
                        logger.warn("Argumento inválido do SGSA");
                        logger.warn("Ignorando pedido de impressão");
                        return;
                    }
                    String tipoImpressora = msgInicialArray[2];
                    
                    SGSA sgsa = new SGSA(clientSocket);
                    String text = sgsa.readText();
                    logger.info("Pedido de impressão recebido de SGSA para a impressora tipo: " + tipoImpressora);
                    logger.info("Texto para impressão: " + text);
                    this.sendText(text, id);
                    return;
                } 
                if (msgInicial.contains("SGSA:LIST")) {
                    logger.info("SGSA solicita lista de impressoras");
                    return;
                }
                if (msgInicial.contains("CLIENT:PRINTER")) {
                    logger.info("Cliente de impressão conectado");
                    if(msgInicialArray.length != 3){
                        logger.warn("Argumento inválido do SGSA");
                        logger.warn("Ignorando pedido de impressão");
                        return;
                    }
                    
                    Client client = new Client(clientSocket, id);
                    
                    if(msgInicialArray[2].equalsIgnoreCase("RECIBO")){
                        client.setSuporte(Client.SUPORTE_RECIBO);
                    }else if(msgInicialArray[2].equalsIgnoreCase("ETIQUETA")){
                        client.setSuporte(Client.SUPORTE_ETIQUETA);
                    }else if(msgInicialArray[2].equalsIgnoreCase("RECIBO_E_ETIQUETA")){
                        client.setSuporte(Client.SUPORTE_RECIBO_E_ETIQUETA);
                    } else {
                        logger.warn("Tipo de impressora não suportado: "+msgInicialArray[2]);
                        return;
                    }
                    client.start();
                    this.clients.add(client);
                    return;
                }
                logger.warn("A mensagem recebida é inválida");
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
