package Elgin;

import java.io.IOException;
import java.io.InputStream;
import java.io.StringWriter;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Iterator;
import javax.print.Doc;
import javax.print.DocFlavor;
import javax.print.DocPrintJob;
import javax.print.PrintService;
import javax.print.PrintServiceLookup;
import javax.print.SimpleDoc;
import javax.print.attribute.Attribute;
import javax.print.attribute.AttributeSet;
import javax.print.attribute.PrintServiceAttribute;
import javax.print.attribute.PrintServiceAttributeSet;

/**
 *
 * @author thiago
 */
public class sputaIlRospo {

    public void printerStatus() {
        PrintService printer = PrintServiceLookup.lookupDefaultPrintService();
        AttributeSet att = printer.getAttributes();
        for (Attribute a : att.toArray()) {
            String attributeName;
            String attributeValue;
            attributeName = a.getName();
            attributeValue = att.get(a.getClass()).toString();
            System.out.println(attributeName + " : " + attributeValue);
        }
    }

    public void test() {
        PrintService psZebra = null;
        String sPrinterName = null;
        PrintService[] services = PrintServiceLookup.lookupPrintServices(null, null);
        for (int i = 0; i < services.length; i++) {
            System.out.println(services[i].getName());
            PrintServiceAttributeSet set = services[i].getAttributes();
            for (int k = 0; k < set.size(); k++) {
            }
            if (services[i].getName().equalsIgnoreCase("BTP-L42(U)")) {
                //psZebra = services[i];
                System.out.println("acho a impressora");
                break;
            }
        }
    }

    public static void main(String args[]) {
        sputaIlRospo l = new sputaIlRospo();
        //l.imprime();
        l.test();
        l.printerStatus();
        // Sample usage
        String value = l.readRegistry("HKCU\\Software\\Microsoft\\Windows\\CurrentVersion\\"
                + "Explorer\\Shell Folders", "Personal");
        System.out.println(value);
    }

    public void imprime() {
        System.out.println("sputaIlRospo Zebra Print testing!");

        // Prepare date to print in dd/mm/yyyy format
        Date now = new Date();
        SimpleDateFormat format = new SimpleDateFormat("dd/MM/yyyy");
        String dateString = format.format(now);

        // Search for an installed zebra printer...
        // is a printer with "zebra" in its name
        try {
            PrintService psZebra = null;
            String sPrinterName = null;
            PrintService[] services = PrintServiceLookup.lookupPrintServices(null, null);
            for (int i = 0; i < services.length; i++) {
                if (services[i].getName().equalsIgnoreCase("BTP-L42(U)")) {
                    psZebra = services[i];
                    break;
                }
            }

            if (psZebra == null) {
                System.out.println("Zebra printer is not found.");
                return;
            }

            System.out.println("Found printer: " + sPrinterName);
            DocPrintJob job = psZebra.createPrintJob();

            // Prepare string to send to the printer
            /*String s = "R0,0\n" + // Set Reference Point                                                             
             "N\n" + // Clear Image Buffer                                                             
             "ZB\n" + // Print direction (from Bottom of buffer)
             "Q122,16\n" + // Set label Length and gap
             "A160,2,0,3,1,1,N,\"DATA: " + dateString + " - CARUGATE\"\n"
             + "B160,30,0,1A,2,7,50,N,\"612041600021580109\"\n"
             + "A160,92,0,1,1,1,N,\"AIA AGRICOLA IT.ALIMENT.S - 594679/VR                       \"\n"
             + "P1\n";   // Print content of buffer, 1 label*/

            // Prepare string to send to the printer
            String s = "R0,0\n" + // Set Reference Point                                                             
                    "N\n" + // Clear Image Buffer                                                             
                    "ZB\n" + // Print direction (from Bottom of buffer)
                    "Q122,16\n" + // Set label Length and gap
                    "A50,150,0,4,1,1,N,\"NOME DO ouvinte FICA AQUI\"\n"
                    + "B100,450,0,3,5,11,50,B,\"12345\"\n" // 5:11 eh o tamanho ideal, naum mude
                    //+ "A100,500,0,1,1,1,N,\"AIA AGRICOLA IT.ALIMENT.S - 594679/VR                       \"\n"
                    + "P1\n";   // Print content of buffer, 1 label*/

            byte[] by = s.getBytes();
            DocFlavor flavor = DocFlavor.BYTE_ARRAY.AUTOSENSE;
            // MIME type = "application/octet-stream",
            // print data representation class name = "[B" (byte array).
            Doc doc = new SimpleDoc(by, flavor, null);

            System.out.println("Pronti alla stampa");
            job.print(doc, null);
            System.out.println("Stampa inviata");

        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    /**
     *
     * @param location path in the registry
     * @param key registry key
     * @return registry value or null if not found
     */
    public static final String readRegistry(String location, String key) {
        try {
            // Run reg query, then read output with StreamReader (internal class)
            String command = "REG QUERY \"HKLM\\Software\\Microsoft\\Windows NT\\CurrentVersion\\Print\\Printers\" /s /f BTP-L42(U) /c /e";
            System.out.println(command);
            //Process process = Runtime.getRuntime().exec("reg query " + '"' + location + "\" /v " + key);
            Process process = Runtime.getRuntime().exec(command);

            StreamReader reader = new StreamReader(process.getInputStream());
            reader.start();
            process.waitFor();
            reader.join();
            String output = reader.getResult();

            System.out.println(output);
            // Output has the following format:
            // \n<Version information>\n\n<key>\t<registry type>\t<value>
            if (!output.contains("\t")) {
                return null;
            }

            // Parse out the value
            String[] parsed = output.split("\t");
            return parsed[parsed.length - 1];
        } catch (Exception e) {
            e.printStackTrace();
            return null;
        }

    }

    private static class StreamReader extends Thread {

        private InputStream is;
        private StringWriter sw = new StringWriter();

        public StreamReader(InputStream is) {
            this.is = is;
        }

        public void run() {
            try {
                int c;
                while ((c = is.read()) != -1) {
                    sw.write(c);
                }
            } catch (IOException e) {
                e.printStackTrace();
            }
        }

        public String getResult() {
            return sw.toString();
        }
    }
}