/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import java.io.Serializable;
import java.util.Date;
import javax.persistence.*;
import javax.xml.bind.annotation.XmlRootElement;

/**
 *
 * @author nasser
 */
@Entity
@Table(name = "PALESTRA")
@XmlRootElement
@NamedQueries({
    @NamedQuery(name = "Palestra.findAll", query = "SELECT p FROM Palestra p"),
    @NamedQuery(name = "Palestra.findByIdPalestra", query = "SELECT p FROM Palestra p WHERE p.idPalestra = :idPalestra"),
    @NamedQuery(name = "Palestra.findByNomePalestra", query = "SELECT p FROM Palestra p WHERE p.nomePalestra = :nomePalestra"),
    @NamedQuery(name = "Palestra.findByNomePalestrante", query = "SELECT p FROM Palestra p WHERE p.nomePalestrante = :nomePalestrante"),
    @NamedQuery(name = "Palestra.findByInstituicao", query = "SELECT p FROM Palestra p WHERE p.instituicao = :instituicao"),
    @NamedQuery(name = "Palestra.findByHoraInicioPrevista", query = "SELECT p FROM Palestra p WHERE p.horaInicioPrevista = :horaInicioPrevista"),
    @NamedQuery(name = "Palestra.findByHoraFimPrevista", query = "SELECT p FROM Palestra p WHERE p.horaFimPrevista = :horaFimPrevista"),
    @NamedQuery(name = "Palestra.findByHoraInicio", query = "SELECT p FROM Palestra p WHERE p.horaInicio = :horaInicio"),
    @NamedQuery(name = "Palestra.findByHoraFim", query = "SELECT p FROM Palestra p WHERE p.horaFim = :horaFim"),
    @NamedQuery(name = "Palestra.findBySala", query = "SELECT p FROM Palestra p WHERE p.sala = :sala"),
    @NamedQuery(name = "Palestra.findByDia", query = "SELECT p FROM Palestra p WHERE p.dia = :dia")})
public class Palestra implements Serializable {
    private static final long serialVersionUID = 1L;
    @Id
    @Basic(optional = false)
    @Column(name = "ID_PALESTRA")
    private Integer idPalestra;
    @Column(name = "NOME_PALESTRA")
    private String nomePalestra;
    @Column(name = "NOME_PALESTRANTE")
    private String nomePalestrante;
    @Column(name = "INSTITUICAO")
    private String instituicao;
    @Column(name = "HORA_INICIO_PREVISTA")
    @Temporal(TemporalType.TIME)
    private Date horaInicioPrevista;
    @Column(name = "HORA_FIM_PREVISTA")
    @Temporal(TemporalType.TIME)
    private Date horaFimPrevista;
    @Column(name = "HORA_INICIO")
    @Temporal(TemporalType.TIME)
    private Date horaInicio;
    @Column(name = "HORA_FIM")
    @Temporal(TemporalType.TIME)
    private Date horaFim;
    @Column(name = "SALA")
    private String sala;
    @Column(name = "DIA")
    @Temporal(TemporalType.DATE)
    private Date dia;

    public Palestra() {
    }

    public Palestra(Integer idPalestra) {
        this.idPalestra = idPalestra;
    }

    public Integer getIdPalestra() {
        return idPalestra;
    }

    public void setIdPalestra(Integer idPalestra) {
        this.idPalestra = idPalestra;
    }

    public String getNomePalestra() {
        return nomePalestra;
    }

    public void setNomePalestra(String nomePalestra) {
        this.nomePalestra = nomePalestra;
    }

    public String getNomePalestrante() {
        return nomePalestrante;
    }

    public void setNomePalestrante(String nomePalestrante) {
        this.nomePalestrante = nomePalestrante;
    }

    public String getInstituicao() {
        return instituicao;
    }

    public void setInstituicao(String instituicao) {
        this.instituicao = instituicao;
    }

    public Date getHoraInicioPrevista() {
        return horaInicioPrevista;
    }

    public void setHoraInicioPrevista(Date horaInicioPrevista) {
        this.horaInicioPrevista = horaInicioPrevista;
    }

    public Date getHoraFimPrevista() {
        return horaFimPrevista;
    }

    public void setHoraFimPrevista(Date horaFimPrevista) {
        this.horaFimPrevista = horaFimPrevista;
    }

    public Date getHoraInicio() {
        return horaInicio;
    }

    public void setHoraInicio(Date horaInicio) {
        this.horaInicio = horaInicio;
    }

    public Date getHoraFim() {
        return horaFim;
    }

    public void setHoraFim(Date horaFim) {
        this.horaFim = horaFim;
    }

    public String getSala() {
        return sala;
    }

    public void setSala(String sala) {
        this.sala = sala;
    }

    public Date getDia() {
        return dia;
    }

    public void setDia(Date dia) {
        this.dia = dia;
    }

    @Override
    public int hashCode() {
        int hash = 0;
        hash += (idPalestra != null ? idPalestra.hashCode() : 0);
        return hash;
    }

    @Override
    public boolean equals(Object object) {
        // TODO: Warning - this method won't work in the case the id fields are not set
        if (!(object instanceof Palestra)) {
            return false;
        }
        Palestra other = (Palestra) object;
        if ((this.idPalestra == null && other.idPalestra != null) || (this.idPalestra != null && !this.idPalestra.equals(other.idPalestra))) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "model.Palestra[ idPalestra=" + idPalestra + " ]";
    }
    
}
