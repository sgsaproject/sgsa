
import org.apache.log4j.Logger;

/**
 *
 * @author thiago
 */
public class Main {

    public static Logger logger = Logger.getLogger(Main.class);

    public static void main(String[] args) {

        logger.info("Inicializando");

        Client.readConfig();
        new Client(1, Client.getProperty("port")).init();

        logger.info("Finalizando");
    }
}
