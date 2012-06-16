/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


import com.sun.jna.Native;

class TesteBematech {
   
    public static void main(String[] args) {
//        System.loadLibrary("mp2032");
        Mp2032 lib = (Mp2032) Native.loadLibrary("mp2032", Mp2032.class);
        System.out.println(lib.IniciaPorta("COM3"));
        System.out.println(lib.ConfiguraModeloImpressora(5));
        System.out.println(lib.BematechTX("teste\n"));
        System.out.println(lib.BematechTX("teste\n"));
        System.out.println(lib.AcionaGuilhotina(1));
        System.out.println(lib.FechaPorta());
    }
}