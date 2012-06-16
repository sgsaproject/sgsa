/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package impressoranaofiscal;

import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.PrintStream;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author thiago
 */
public class ImpressoraNaoFiscal {

    public static void main(String[] args) {
        ImpressoraNaoFiscal imp = new ImpressoraNaoFiscal();
        imp.teste();
    }

    public void teste() {
        FileOutputStream fos = null;
        PrintStream ps = null;
        try {
            //fos = new FileOutputStream("\\\\localhost\\Generic");
            fos = new FileOutputStream("\\\\localhost\\MP4200");
        } catch (FileNotFoundException ex) {
            ex.printStackTrace();
        }
        ps = new PrintStream(fos);
        ps.println("Coloque aqui o que você quer imprimir");
        ps.flush();
        try {
            fos.flush();
        } catch (IOException ex) {
            Logger.getLogger(ImpressoraNaoFiscal.class.getName()).log(Level.SEVERE, null, ex);
        }
        ps.close();
        try {
            fos.close();
        } catch (IOException ex) {
            Logger.getLogger(ImpressoraNaoFiscal.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
}
