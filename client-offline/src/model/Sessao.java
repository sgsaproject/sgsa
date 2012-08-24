package model;

import java.util.Date;
import org.apache.log4j.Logger;
import util.Data;
import util.DataException;

/**
 *
 * @author thiago
 */
public class Sessao {
    
    public static Logger logger = Logger.getLogger(Sessao.class);
    
    private int id;
    private Ouvinte ouvinte;
    private Palestra palestra;
    private Date horaEntrada;
    private Date horaSaida;

    public Sessao() {
    }

    public Sessao(int id, Ouvinte ouvinte, Palestra palestra, Date horaEntrada, Date horaSaida) {
        this.id = id;
        this.ouvinte = ouvinte;
        this.palestra = palestra;
        this.horaEntrada = horaEntrada;
        this.horaSaida = horaSaida;
    }

    /**
     * @return the id
     */
    public int getId() {
        return id;
    }

    /**
     * @param id the id to set
     */
    public void setId(int id) {
        this.id = id;
    }

    /**
     * @return the ouvinte
     */
    public Ouvinte getOuvinte() {
        return ouvinte;
    }

    /**
     * @param ouvinte the ouvinte to set
     */
    public void setOuvinte(Ouvinte ouvinte) {
        this.ouvinte = ouvinte;
    }

    /**
     * @return the palestra
     */
    public Palestra getPalestra() {
        return palestra;
    }

    /**
     * @param palestra the palestra to set
     */
    public void setPalestra(Palestra palestra) {
        this.palestra = palestra;
    }

    /**
     * @return the horaEntrada
     */
    public Date getHoraEntrada() {
        return this.horaEntrada;
    }
    
    /**
     * @return the horaEntrada
     */
    public String getHoraEntradaString() {
        return Data.getTime(horaEntrada);
    }

    /**
     * @param horaEntrada the horaEntrada to set
     */
    public void setHoraEntrada(Date horaEntrada) {
        this.horaEntrada = horaEntrada;
    }
    
    /**
     * @param horaEntrada the horaEntrada to set
     */
    public void setHoraEntrada(String dia, String horaEntrada) {
        try {
            this.horaEntrada = Data.getDataHora(dia, horaEntrada);
        } catch (DataException ex) {
            logger.fatal(ex);
        }
    }

    /**
     * @return the horaSaida
     */
    public Date getHoraSaida() {
        return this.horaSaida;
    }
    
    /**
     * @return the horaSaida
     */
    public String getHoraSaidaString() {
        return Data.getTime(horaSaida);
    }

    /**
     * @param horaSaida the horaSaida to set
     */
    public void setHoraSaida(Date horaSaida) {
        this.horaSaida = horaSaida;
    }
    
    /**
     * @param horaSaida the horaSaida to set
     */
    public void setHoraSaida(String dia, String horaSaida) {
        try {
            this.horaSaida = Data.getDataHora(dia, horaSaida);
        } catch (DataException ex) {
            logger.fatal(ex);
        }
    }
    
}
