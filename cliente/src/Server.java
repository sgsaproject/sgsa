
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.Socket;
import java.net.UnknownHostException;

/**
 *
 * @author thiago
 */
public class Server {

    private String ip;
    private int port;
    private Socket socket;

    public Server(String ip) throws UnknownHostException, IOException {
        this.ip = ip;
        this.port = 5588;
        this.socket = new Socket(ip, port);
    }

    public String getIp() {
        return ip;
    }

    public void setIp(String ip) {
        this.ip = ip;
    }

    public Socket getSocket() {
        return socket;
    }

    public void setSocket(Socket socket) {
        this.socket = socket;
    }

    public int getPort() {
        return port;
    }

    public void setPort(int port) {
        this.port = port;
    }
    
    public OutputStream getOutputStream() throws IOException {
        return this.socket.getOutputStream();
    }
    
    public InputStream getInputStream() throws IOException {
        return this.socket.getInputStream();
    }
}
