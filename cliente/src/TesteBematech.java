
import com.sun.jna.Native;
import javax.swing.JOptionPane;

class TesteBematech {
    
    public void testeL42() {

    }

    public static void main(String[] args) {
        byte escape = 27;
        byte cr = 13;
        byte lf = 10;
        byte negrito1 = 69;
        byte negrito2 = 70;
        byte italico1 = 52;
        byte italico2 = 53;
        byte expandido1 = 1;
        byte expandido2 = 48;
        byte expandidoNormal = 87;
        byte expandidoDuplo = 100;
        byte condensado1 = 15;
        byte condensado2 = 18;
        try {
            Mp2032 lib = (Mp2032) Native.loadLibrary("mp2032", Mp2032.class);
            JOptionPane.showMessageDialog(null, lib.IniciaPorta("COM3"));
            JOptionPane.showMessageDialog(null, lib.ConfiguraModeloImpressora(7));
            JOptionPane.showMessageDialog(null, lib.BematechTX((char)escape + "" + (char)negrito1 + "texto negrito" + (char)escape + "" + (char)negrito2 + "" + (char)cr + "" + (char)lf));
            JOptionPane.showMessageDialog(null, lib.BematechTX((char)escape + "" + (char)italico1 + "texto italico" + (char)escape + "" + (char)italico2 + "" + (char)cr + "" + (char)lf));
            JOptionPane.showMessageDialog(null, lib.BematechTX((char)escape + "" + (char)expandidoNormal + "" + (char)expandido1 + "texto expandido" + (char)escape + "" + (char)expandidoNormal + "" + (char)expandido2 + "" + (char)cr + "" + (char)lf));
            JOptionPane.showMessageDialog(null, lib.BematechTX((char)condensado1 + "texto condensado" + (char)condensado2 + "" + (char)cr + "" + (char)lf));
            JOptionPane.showMessageDialog(null, lib.BematechTX((char)escape + "" + (char)expandidoDuplo + "" + (char)expandido1 + "texto expandido duplo" + (char)escape + "" + (char)expandidoDuplo + "" + (char)expandido2 + "" + (char)cr + "" + (char)lf));
            JOptionPane.showMessageDialog(null, lib.BematechTX((char)escape + "" + (char)expandidoNormal + "" + (char)expandido1 + "" + (char)escape + "" + (char)expandidoDuplo + "" + (char)expandido1 + "texto expandido duplo 2" + (char)escape + "" + (char)expandidoDuplo + "" + (char)expandido2 + "" + (char)escape + "" + (char)expandidoNormal + "" + (char)expandido2 + "" + (char)cr + "" + (char)lf));
            JOptionPane.showMessageDialog(null, lib.AcionaGuilhotina(1));
            String abreGaveta = (char)27 + "" + (char)118 + "" + (char)140; // Abre gaveta
            JOptionPane.showMessageDialog(null, lib.ComandoTX(abreGaveta, abreGaveta.length()));
            JOptionPane.showMessageDialog(null, lib.FechaPorta());
            
        } catch (Exception e) {
            e.printStackTrace();
            JOptionPane.showMessageDialog(null, e.getStackTrace());
        }
    }
    
    public static void mmain(String[] args) {
        byte escape = 27;
        byte cr = 13;
        byte lf = 10;
        byte negrito1 = 69;
        byte negrito2 = 70;
        byte italico1 = 52;
        byte italico2 = 53;
        byte expandido1 = 1;
        byte expandido2 = 48;
        byte expandidoNormal = 87;
        byte expandidoDuplo = 100;
        byte condensado1 = 15;
        byte condensado2 = 18;
        try {
            Mp2032 lib = (Mp2032) Native.loadLibrary("mp2032", Mp2032.class);
            JOptionPane.showMessageDialog(null, lib.IniciaPorta("COM3"));
            JOptionPane.showMessageDialog(null, lib.ConfiguraModeloImpressora(7));
            JOptionPane.showMessageDialog(null, lib.BematechTX((char)27 + "" + (char)69 + "texto negrito" + (char)27 + "" + (char)70 + "" + (char)13 + "" + (char)10));
            JOptionPane.showMessageDialog(null, lib.AcionaGuilhotina(1));
            JOptionPane.showMessageDialog(null, lib.FechaPorta());
            
        } catch (Exception e) {
            e.printStackTrace();
            JOptionPane.showMessageDialog(null, e.getStackTrace());
        }
    }
}