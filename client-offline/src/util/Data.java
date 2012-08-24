package util;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.GregorianCalendar;

/**
 * Classe para a manipulação das datas do banco de dados e do java.
 *
 * @author thiago
 * @see Data
 * @see GregorianCalendar
 * @see SimpleDateFormat
 */
public class Data {

    private static String DATE = "dd/MM/yyyy";
    private static String TIME = "HH:mm:ss";
    private static String HOUR = "H";
    private static String MINUTE = "m";
    private static String DATE_DATABASE = "yyyy-MM-dd";

    /**
     * Método para converter uma data do tipo Date para uma String. O formato de
     * saída da String será "dd/MM/yyyy"
     *
     * @param data a data no tipo Date
     * @return {@link String} no formato "dd/MM/yyyy"
     */
    public static String getDate(Date data) {
        DateFormat date = new SimpleDateFormat(DATE);
        return date.format(data);
    }

    /**
     * Método para converter uma data do tipo Date para uma String. O formato de
     * saída da String será "yyyy-MM-dd"
     *
     * @param data a data no tipo Date
     * @return {@link String} no formato "yyyy-MM-dd"
     */
    public static String getDateDatabase(Date data) {
        DateFormat date = new SimpleDateFormat(DATE_DATABASE);
        return date.format(data);
    }

    /**
     * Método para converter uma hora do tipo Date para uma String. O formato de
     * saída da String será "HH:mm:ss"
     *
     * @param hora a hora no tipo Date
     * @return {@link String} no formato "HH:mm:ss"
     */
    public static String getTime(Date hora) {
        DateFormat date = new SimpleDateFormat(TIME);
        return date.format(hora);
    }

    /**
     * Método para pegar a hora de um objeto Date.
     *
     * @param time a hora no tipo Date
     * @return {@link int} a hora da data de 0-23
     */
    public static int getHour(Date time) {
        DateFormat date = new SimpleDateFormat(HOUR);
        return Integer.parseInt(date.format(time));
    }

    /**
     * Método para pegar o minuto de um objeto Date.
     *
     * @param time a hora no tipo Date
     * @return {@link int} o minuto da data de 0-23
     */
    public static int getMinute(Date time) {
        DateFormat date = new SimpleDateFormat(MINUTE);
        return Integer.parseInt(date.format(time));
    }

    /**
     * Recebe uma String de uma data no seguinte formato: "dd/MM/yyyy" e
     * converte para Date.
     *
     * @param data uma String de uma data no formato "dd/MM/yyyy"
     * @return {@link Date}
     */
    public static Date getDate(String data) throws DataException {
        int[] numeros = getDataNumbers(data);
        Calendar calendar = new GregorianCalendar(numeros[2], (numeros[1] - 1), numeros[0]);
        return (calendar.getTime());
    }

    /**
     * Recebe uma String de uma data no seguinte formato: "dd/MM/yyyy" e
     * converte para os números da data. O resultado será um vetor com o dia,
     * mês e ano.
     *
     * @param data uma String de uma data no formato "dd/MM/yyyy"
     * @return int[] um vetor com o dia, mês e ano
     * @throws DataException
     */
    private static int[] getDataNumbers(String data) throws DataException { //OK
        String[] string = data.split("/");
        if (string.length == 3) {
            int[] numeros = new int[3];
            for (int i = 0; i < string.length; i++) {
                numeros[i] = Integer.parseInt(string[i]);
            }
            return new int[]{numeros[0], numeros[1], numeros[2]};
        } else {
            throw new DataException("Número de argumentos inválidos! Correto: 3. Enviado: " + string.length);
        }
    }

    /**
     * Rebece uma String de uma data no seguinte formato: "dd/MM/yyyy" e outra
     * String no seguinte formato: "HH:mm:ss" e converte para Date.
     *
     * @param date uma String de uma data no formato "dd/MM/yyyy"
     * @param time uma String de uma hora no formato "HH:mm:ss"
     * @return {@link Date}
     */
    public static Date getDataHora(String date, String time) throws DataException {
        int ano, mes, dia, hor, minuto, segundo;
        int[] numerosData = getDataNumbers(date);
        ano = numerosData[2];
        mes = (numerosData[1] - 1);
        dia = numerosData[0];

        String[] string = time.split(":");
        if (string.length == 3) {
            int[] numeros = new int[3];
            for (int i = 0; i < string.length; i++) {
                numeros[i] = Integer.parseInt(string[i]);
            }
            segundo = numeros[2];
            minuto = (numeros[1]);
            hor = numeros[0];
        } else {
            throw new DataException("Número de argumentos inválidos! Correto: 3. Enviado: " + string.length);
        }

        Calendar calendar = new GregorianCalendar(ano, mes, dia, hor, minuto, segundo);
        return (calendar.getTime());
    }

    /**
     * Pega o dia e hora atual do sistema e retorna como um Date
     *
     * @return a data e hora atual em Date.
     */
    public static Date getCurrentTime() {
        return new Date(System.currentTimeMillis());
    }
}
