/**
 *
 * @author thiago
 */
public abstract class Printer {
    
    protected boolean debug = false;
    
    public abstract void imprimir(String texto) throws Exception;
    public abstract boolean conectada();
    
    public void setDebugMode(boolean valor){
        this.debug = valor;
    }
}
