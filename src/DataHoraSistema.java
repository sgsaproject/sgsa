/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


import com.sun.jna.Structure;

public class DataHoraSistema extends Structure {

    public short wYear;
    public short wMonth;
    public short wDayOfWeek;
    public short wDay;
    public short wHour;
    public short wMinute;
    public short wSecond;
    public short wMilliseconds;
}