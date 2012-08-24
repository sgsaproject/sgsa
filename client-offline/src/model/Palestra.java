package model;

import java.util.ArrayList;
import java.util.Collection;
import java.util.Date;
import org.apache.log4j.Logger;
import util.Data;
import util.DataException;

/**
 *
 * @author thiago
 */
public class Palestra {
    
    public static Logger logger = Logger.getLogger(Palestra.class);

    private int id;
    private String nome;
    private String palestrante;
    private String instituicao;
    private Date horaInicioPrevista;
    private Date horaFimPrevista;
    private Date horaInicio;
    private Date horaFim;
    private String sala;
    private ArrayList<Sessao> sessoes;

    public Palestra() {
        sessoes = new ArrayList<>();
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
     * @return the nome
     */
    public String getNome() {
        return nome;
    }

    /**
     * @param nome the nome to set
     */
    public void setNome(String nome) {
        this.nome = nome;
    }

    /**
     * @return the palestrante
     */
    public String getPalestrante() {
        return palestrante;
    }

    /**
     * @param palestrante the palestrante to set
     */
    public void setPalestrante(String palestrante) {
        this.palestrante = palestrante;
    }

    /**
     * @return the instituicao
     */
    public String getInstituicao() {
        return instituicao;
    }

    /**
     * @param instituicao the instituicao to set
     */
    public void setInstituicao(String instituicao) {
        this.instituicao = instituicao;
    }
    
    /**
     * @return the horaInicioPrevista
     */
    public String getHoraInicioPrevista() {
        return Data.getTime(horaInicioPrevista);
    }

    /**
     * @param horaInicioPrevista the horaInicioPrevista to set
     */
    public void setHoraInicioPrevista(String dia, String horaInicioPrevista) {
        try {
            this.horaInicioPrevista = Data.getDataHora(dia, horaInicioPrevista);
        } catch (DataException ex) {
            logger.fatal(ex);
        }
    }

    /**
     * @return the horaFimPrevista
     */
    public String getHoraFimPrevista() {
        return Data.getTime(horaFimPrevista);
    }

    /**
     * @param horaFimPrevista the horaFimPrevista to set
     */
    public void setHoraFimPrevista(String dia, String horaFimPrevista) {
        try {
            this.horaFimPrevista = Data.getDataHora(dia, horaFimPrevista);
        } catch (DataException ex) {
            logger.fatal(ex);
        }
    }

    /**
     * @return the horaInicio
     */
    public String getHoraInicio() {
        return Data.getTime(horaInicio);
    }

    /**
     * @param horaInicio the horaInicio to set
     */
    public void setHoraInicio(String dia, String horaInicio) {
        try {
            this.horaInicio = Data.getDataHora(dia, horaInicio);
        } catch (DataException ex) {
            logger.fatal(ex);
        }
    }

    /**
     * @return the horaFim
     */
    public String getHoraFim() {
        return Data.getTime(horaFim);
    }

    /**
     * @param horaFim the horaFim to set
     */
    public void setHoraFim(String dia, String horaFim) {
        try {
            this.horaFim = Data.getDataHora(dia, horaFim);
        } catch (DataException ex) {
            logger.fatal(ex);
        }
    }

    /**
     * @return the sala
     */
    public String getSala() {
        return sala;
    }

    /**
     * @param sala the sala to set
     */
    public void setSala(String sala) {
        this.sala = sala;
    }
    
    public ArrayList<Sessao> getSessoes() {
        return this.sessoes;
    }

    public void setSessoes(ArrayList<Sessao> sessoes) {
        this.sessoes = sessoes;
    }
    
    public boolean addSessao(Sessao sessao) {
        return this.sessoes.add(sessao);
    }
    
    public boolean addSessoes(Collection<? extends Sessao> sessoes) {
        return this.sessoes.addAll(sessoes);
    }
    
    public boolean removeSessao(Sessao sessao) {
        return this.sessoes.remove(sessao);
    }
    
    public boolean removeSessoes(Collection<? extends Sessao> sessoes) {
        return this.sessoes.removeAll(sessoes);
    }
}
