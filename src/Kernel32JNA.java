/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


import com.sun.jna.Native;

public class Kernel32JNA {

    public static void main(String args[]) {
        IKernel32 lib =
                (IKernel32) Native.loadLibrary("kernel32", IKernel32.class);
        DataHoraSistema time = new DataHoraSistema();
        lib.GetSystemTime(time);
        System.out.println("Data: " + time.wDay
                + "/" + time.wMonth
                + "/" + time.wYear);
        System.out.println("Hora: "
                + time.wHour
                + ":"
                + time.wMinute);
    }
}