package Elgin;

import java.text.SimpleDateFormat;
import java.util.Date;
import javax.print.Doc;
import javax.print.DocFlavor;
import javax.print.DocPrintJob;
import javax.print.PrintService;
import javax.print.PrintServiceLookup;
import javax.print.SimpleDoc;

/**
 *
 * @author thiago
 */
public class sputaIlRospo {

    public static void main(String args[]) {

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
}