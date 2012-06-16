/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


import com.sun.jna.win32.StdCallLibrary;

public interface IKernel32 extends StdCallLibrary {

    void GetSystemTime(DataHoraSistema result);
}