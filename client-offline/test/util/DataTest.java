/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package util;

import java.util.Date;
import java.util.GregorianCalendar;
import java.util.logging.Level;
import java.util.logging.Logger;
import org.junit.After;
import org.junit.AfterClass;
import org.junit.Before;
import org.junit.BeforeClass;
import org.junit.Test;
import static org.junit.Assert.*;

/**
 *
 * @author thiago
 */
public class DataTest {

    public DataTest() {
    }

    @BeforeClass
    public static void setUpClass() throws Exception {
    }

    @AfterClass
    public static void tearDownClass() throws Exception {
    }

    @Before
    public void setUp() {
    }

    @After
    public void tearDown() {
    }

    /**
     * Test of getData method, of class Data.
     */
    @Test
    public void testGetData_Date() {
        System.out.println("getDataDate");
        String expResult = "10/10/2010";
        Date data = null;
        try {
            data = Data.getDate(expResult);
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
        }
        String result = Data.getDate(data);
        assertEquals(expResult, result);
    }

    @Test
    public void testGetData_DateTime() {
        System.out.println("getDataDateTime");
        String d = "10/10/2010";
        String h = "03:11:32";
        String expResult = "10/10/2010";
        Date data = null;
        try {
            data = Data.getDataHora(d, h);
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
        }
        String result = Data.getDate(data);
        assertEquals(expResult, result);
    }

    @Test
    public void testGetData_DateNull() {
        System.out.println("getDataNull");
        Date expResult = null;
        String result = null;
        try {
            result = Data.getDate(expResult);
            fail("Data nula!");
        } catch (NullPointerException e) {
            assertEquals(expResult, result);
        }
    }

    /**
     * Test of getDataBanco method, of class Data.
     */
    @Test
    public void testGetDataBanco_Date() {
        System.out.println("getDataBancoDate");
        String expResult = "2012-10-10";
        Date data = null;
        try {
            data = Data.getDate("10/10/2012");
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
        }
        String result = Data.getDateDatabase(data);
        assertEquals(expResult, result);
    }

    @Test
    public void testGetDataBanco_DateTime() {
        System.out.println("getDataBancoDateTime");
        String expResult = "2012-10-10";
        Date data = null;
        try {
            data = Data.getDataHora("10/10/2012", "04:21:11");
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
        }
        String result = Data.getDateDatabase(data);
        assertEquals(expResult, result);
    }

    @Test
    public void testGetDataBanco_DateNull() {
        System.out.println("getDataBancoDateNull");
        String expResult = null;
        Date data = null;
        String result = null;
        try {
            result = Data.getDateDatabase(data);
            fail("Data aceitando null!");
        } catch (NullPointerException e) {
            assertEquals(expResult, result);
        }
    }

    /**
     * Test of getHora method, of class Data.
     */
    @Test
    public void testGetHora_Date() {
        System.out.println("getHoraDate");
        Date hora = null;
        try {
            hora = Data.getDate("03/03/2003");
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
        }
        String expResult = "00:00:00";
        String result = Data.getTime(hora);
        assertEquals(expResult, result);
    }

    @Test
    public void testGetHora_DateTime() {
        System.out.println("getHoraDateTime");
        String expResult = "12:32:03";
        Date hora = null;
        try {
            hora = Data.getDataHora("03/03/2003", expResult);
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
        }
        String result = Data.getTime(hora);
        assertEquals(expResult, result);
    }

    @Test
    public void testGetHora_DateNull() {
        System.out.println("getHoraDateNull");
        Date hora = null;
        String expResult = null;
        String result = null;
        try {
            result = Data.getTime(hora);
            fail("Data aceitando null!");
        } catch (NullPointerException e) {
            assertEquals(expResult, result);
        }
    }

    /**
     * Test of getHoraInt method, of class Data.
     */
    @Test
    public void testGetHoraInt_Date() {
        System.out.println("getHoraIntDate");
        Date hora = null;
        try {
            hora = Data.getDate("31/12/2000");
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
        }
        int expResult = 0;
        int result = Data.getHour(hora);
        assertEquals(expResult, result);
    }

    @Test
    public void testGetHoraInt_DateTime() {
        System.out.println("getHoraIntDateTime");
        Date hora = null;
        try {
            hora = Data.getDataHora("31/12/2000", "18:22:50");
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
        }
        int expResult = 18;
        int result = Data.getHour(hora);
        assertEquals(expResult, result);
    }

    @Test
    public void testGetHoraInt_DateNull() {
        System.out.println("getHoraIntDateNull");
        Date hora = null;
        int expResult = -1;
        int result = -1;
        try {
            result = Data.getHour(hora);
            fail("Data aceitando null!");
        } catch (NullPointerException e) {
            assertEquals(expResult, result);
        }
    }

    /**
     * Test of getMinuto method, of class Data.
     */
    @Test
    public void testGetMinuto_Date() {
        System.out.println("getMinutoDate");
        Date hora = null;
        try {
            hora = Data.getDate("15/09/1999");
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
        }
        int expResult = 0;
        int result = Data.getMinute(hora);
        assertEquals(expResult, result);
    }

    @Test
    public void testGetMinuto_DateTime() {
        System.out.println("getMinutoDateTime");
        Date hora = null;
        try {
            hora = Data.getDataHora("15/09/1999", "02:38:13");
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
        }
        int expResult = 38;
        int result = Data.getMinute(hora);
        assertEquals(expResult, result);
    }

    @Test
    public void testGetMinuto_DateNull() {
        System.out.println("getMinutoDateNull");
        Date hora = null;
        int expResult = -1;
        int result = -1;
        try {
            result = Data.getMinute(hora);
            fail("Data aceitando null!");
        } catch (NullPointerException e) {
            assertEquals(expResult, result);
        }
    }

    /**
     * Test of getData method, of class Data.
     */
    @Test
    public void testGetData_StringDate() {
        System.out.println("getDataDate");
        String data = "22/12/2012";
        Date expResult = new GregorianCalendar(2012, 11, 22).getTime();
        Date result = null;
        try {
            result = Data.getDate(data);
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
        }
        assertEquals(expResult, result);
    }

    @Test
    public void testGetData_StringVazia() {
        System.out.println("getDataVazia");
        String data = "";
        Date expResult = null;
        Date result = null;
        try {
            result = Data.getDate(data);
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
        }
        assertEquals(expResult, result);
    }

    @Test
    public void testGetData_StringNull() {
        System.out.println("getDataNull");
        String data = null;
        Date expResult = null;
        Date result = null;
        try {
            result = Data.getDate(data);
            fail("Data aceitando null!");
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
            fail("Exception errada!");
        } catch (NullPointerException e) {
            assertEquals(expResult, result);
        }
    }

    @Test
    public void testGetData_StringLetras() {
        System.out.println("getDataLetras");
        String data = "abcdefghij";
        Date expResult = null;
        Date result = null;
        try {
            result = Data.getDate(data);
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
        }
        assertEquals(expResult, result);
    }

    @Test
    public void testGetData_StringLetrasFormatadas() {
        System.out.println("getDataLetrasFormatadas");
        String data = "ab/cd/efgh";
        Date expResult = null;
        Date result = null;
        try {
            result = Data.getDate(data);
            fail("Data aceitando letras!");
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
            fail("Excessão errada!");
        } catch (NumberFormatException ex) {
            assertEquals(expResult, result);
        }
    }

    @Test
    public void testGetData_StringDateAbsurda() {
        System.out.println("getDataDateAbsurda");
        String data = "99/99/9999";
        Date expResult = new GregorianCalendar(9999, 98, 99).getTime();
        Date result = null;
        try {
            result = Data.getDate(data);
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
        }
        assertEquals(expResult, result);
    }

    @Test
    public void testGetData_StringDateMaisAbsurda() {
        System.out.println("getDataDateMaisAbsurda");
        String data = "4568970/123468/42384";
        Date expResult = new GregorianCalendar(42384, 123467, 4568970).getTime();
        Date result = null;
        try {
            result = Data.getDate(data);
        } catch (DataException ex) {
            ex.printStackTrace();
        }
        assertEquals(expResult, result);
    }

    @Test
    public void testGetData_StringDateMaisAbsurda2() {
        System.out.println("getDataDateMaisAbsurda2");
        String data = "4568970/-123468/-42384";
        Date expResult = new GregorianCalendar(-42384, -123469, 4568970).getTime();
        Date result = null;
        try {
            result = Data.getDate(data);
        } catch (DataException ex) {
            ex.printStackTrace();
        }
        assertEquals(expResult, result);
    }

    /**
     * Test of getDataHora method, of class Data.
     */
    @Test
    public void testGetDataHoraTime() {
        System.out.println("getDataHoraTime");
        String data = "22/12/2012";
        String hora = "03:20:10";
        Date expResult = new GregorianCalendar(2012, 11, 22, 03, 20, 10).getTime();
        Date result = null;
        try {
            result = Data.getDataHora(data, hora);
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
        }
        assertEquals(expResult, result);
    }

    @Test
    public void testGetDataHoraTimeVazio() {
        System.out.println("getDataHoraTimeVazio");
        String data = "22/12/2012";
        String hora = "";
        Date expResult = null;
        Date result = null;
        try {
            result = Data.getDataHora(data, hora);
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
        }
        assertEquals(expResult, result);
    }

    @Test
    public void testGetDataHoraTimeNull() {
        System.out.println("getDataHoraTimeNull");
        String data = "22/12/2012";
        String hora = null;
        Date expResult = null;
        Date result = null;
        try {
            result = Data.getDataHora(data, hora);
            fail("Data aceitando null!");
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
            fail("Exception errada!");
        } catch (NullPointerException e) {
            assertEquals(expResult, result);
        }
    }

    @Test
    public void testGetDataHoraTimeAbsurdo() {
        System.out.println("getDataHoraTimeAbsurdo");
        String data = "22/12/2012";
        String hora = "3218:1237:3421422";
        Date expResult = new GregorianCalendar(2012, 11, 22, 3218, 1237, 3421422).getTime();
        Date result = null;
        try {
            result = Data.getDataHora(data, hora);
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
        }
        assertEquals(expResult, result);
    }

    @Test
    public void testGetDataHoraTimeAbsurdo2() {
        System.out.println("getDataHoraTimeAbsurdo2");
        String data = "22/12/2012";
        String hora = "-3218:1237:-3421422";
        Date expResult = new GregorianCalendar(2012, 11, 22, -3218, 1237, -3421422).getTime();
        Date result = null;
        try {
            result = Data.getDataHora(data, hora);
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
        }
        assertEquals(expResult, result);
    }

    @Test
    public void testGetDataHoraTimeLetras() {
        System.out.println("getDataHoraTimeLetras");
        String data = "22/12/2012";
        String hora = "sdhufsyudhf";
        Date expResult = null;
        Date result = null;
        try {
            result = Data.getDataHora(data, hora);
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
        }
        assertEquals(expResult, result);
    }

    @Test
    public void testGetDataHoraTimeLetrasFormatadas() {
        System.out.println("getDataHoraTimeLetrasFormatadas");
        String data = "22/12/2012";
        String hora = "asr:aeff:eawea";
        Date expResult = null;
        Date result = null;
        try {
            result = Data.getDataHora(data, hora);
            fail("Data aceitando letras!");
        } catch (DataException ex) {
            Logger.getLogger(DataTest.class.getName()).log(Level.SEVERE, null, ex);
            fail("Exception errada!");
        } catch (NumberFormatException e) {
            assertEquals(expResult, result);
        }
    }

    /**
     * Test of getCurrentTime method, of class Data.
     */
    @Test
    public void testGetCurrentTime() {
        System.out.println("getCurrentTime");
        Date expResult = new Date(System.currentTimeMillis());
        Date result = Data.getCurrentTime();
        assertEquals(expResult, result);
    }

    @Test
    public void testGetCurrentTimeNotNull() {
        System.out.println("getCurrentTimeNull");
        Date result = Data.getCurrentTime();
        assertNotNull(result);
    }
}
