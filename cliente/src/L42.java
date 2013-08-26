
import Elgin.sputaIlRospo;
import java.io.IOException;
import javax.print.Doc;
import javax.print.DocFlavor;
import javax.print.DocPrintJob;
import javax.print.PrintException;
import javax.print.PrintService;
import javax.print.SimpleDoc;
import org.apache.log4j.Logger;

/**
 *
 * @author thiago
 */
public class L42 extends Printer {

    private String texto;
    private PrintService printer;
    public static Logger logger = Logger.getLogger(Client.class);

    public L42() {
        this.texto = "";
    }

    public PrintService getPrinter() {
        return printer;
    }

    public void setPrinter(PrintService printer) {
        this.printer = printer;
    }

    public String getTexto() {
        return texto;
    }

    @Override
    public void imprimir(String texto) throws PrintException, IOException {
        sputaIlRospo l = new sputaIlRospo();
        System.out.println(texto);
        String[] texts = texto.split("\n");
        l.imprime(texts[0], texts[1]);
//        if (this.debug == false) {
//            if (printer == null) {
//                logger.fatal("L42 Printer is not set.");
//                return;
//            }
//            DocPrintJob job = printer.createPrintJob();
//            byte[] by = texto.getBytes();
//            DocFlavor flavor = DocFlavor.BYTE_ARRAY.AUTOSENSE;
//            // MIME type = "application/octet-stream",
//            // print data representation class name = "[B" (byte array).
//            Doc doc = new SimpleDoc(by, flavor, null);
//
//            logger.info("Etiqueta pronta");
//            job.print(doc, null);
//            logger.info("Etiqueta enviada");
//        } else {
//            logger.info("Imprimindo na impressora: " + this.getClass().getName());
//            logger.info(texto);
//        }
    }

    @Override
    public boolean conectada() {
        if (this.debug == true) {
            return this.conectada;
        }
        //verificar se impressora esta conectada aqui
        return true;
    }
    
    
}
