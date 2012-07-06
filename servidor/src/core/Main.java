package core;

/**
 *
 * @author thiago
 */
public class Main {
    
    public static void main(String[] args) {
        Server.readConfig();
        new Server().init();
    }
    
}
