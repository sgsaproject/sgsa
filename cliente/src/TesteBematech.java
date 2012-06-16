/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

import com.sun.jna.Native;
import javax.swing.JOptionPane;

class TesteBematech {

    public static void main(String[] args) {
        try {
            Mp2032 lib = (Mp2032) Native.loadLibrary("mp2032", Mp2032.class);
            JOptionPane.showMessageDialog(null, lib.IniciaPorta("COM3"));
            JOptionPane.showMessageDialog(null, lib.ConfiguraModeloImpressora(7));
            JOptionPane.showMessageDialog(null, lib.BematechTX("teste\n"));
            JOptionPane.showMessageDialog(null, lib.BematechTX("teste\n"));
            JOptionPane.showMessageDialog(null, lib.AcionaGuilhotina(1));
            JOptionPane.showMessageDialog(null, lib.FechaPorta());
        } catch (Exception e) {
            e.printStackTrace();
            JOptionPane.showMessageDialog(null, e.getStackTrace());
        }
    }
}