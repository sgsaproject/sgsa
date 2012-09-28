/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import java.beans.PropertyChangeListener;
import java.beans.PropertyChangeSupport;
import java.io.Serializable;
import java.util.Date;
import javax.persistence.*;
import javax.xml.bind.annotation.XmlRootElement;

/**
 *
 * @author nasser
 */
@Entity
@Table(name = "SESSAO")
@XmlRootElement
@NamedQueries({
    @NamedQuery(name = "Sessao.findAll", query = "SELECT s FROM Sessao s"),
    @NamedQuery(name = "Sessao.findByIdSessao", query = "SELECT s FROM Sessao s WHERE s.idSessao = :idSessao"),
    @NamedQuery(name = "Sessao.findByHoraEntrada", query = "SELECT s FROM Sessao s WHERE s.horaEntrada = :horaEntrada"),
    @NamedQuery(name = "Sessao.findByHoraSaida", query = "SELECT s FROM Sessao s WHERE s.horaSaida = :horaSaida")})
public class Sessao implements Serializable {
    @Transient
    private PropertyChangeSupport changeSupport = new PropertyChangeSupport(this);
    private static final long serialVersionUID = 1L;
    @Id
    @Basic(optional = false)
    @Column(name = "ID_SESSAO")
    private Integer idSessao;
    @Column(name = "HORA_ENTRADA")
    @Temporal(TemporalType.TIME)
    private Date horaEntrada;
    @Column(name = "HORA_SAIDA")
    @Temporal(TemporalType.TIME)
    private Date horaSaida;
    @JoinColumn(name = "ID_PALESTRA", referencedColumnName = "ID_PALESTRA")
    @ManyToOne(optional = false)
    private Palestra idPalestra;
    @JoinColumn(name = "ID_OUVINTE", referencedColumnName = "ID_OUVINTE")
    @ManyToOne(optional = false)
    private Ouvinte idOuvinte;

    public Sessao() {
    }

    public Sessao(Integer idSessao) {
        this.idSessao = idSessao;
    }

    public Integer getIdSessao() {
        return idSessao;
    }

    public void setIdSessao(Integer idSessao) {
        Integer oldIdSessao = this.idSessao;
        this.idSessao = idSessao;
        changeSupport.firePropertyChange("idSessao", oldIdSessao, idSessao);
    }

    public Date getHoraEntrada() {
        return horaEntrada;
    }

    public void setHoraEntrada(Date horaEntrada) {
        Date oldHoraEntrada = this.horaEntrada;
        this.horaEntrada = horaEntrada;
        changeSupport.firePropertyChange("horaEntrada", oldHoraEntrada, horaEntrada);
    }

    public Date getHoraSaida() {
        return horaSaida;
    }

    public void setHoraSaida(Date horaSaida) {
        Date oldHoraSaida = this.horaSaida;
        this.horaSaida = horaSaida;
        changeSupport.firePropertyChange("horaSaida", oldHoraSaida, horaSaida);
    }

    public Palestra getIdPalestra() {
        return idPalestra;
    }

    public void setIdPalestra(Palestra idPalestra) {
        Palestra oldIdPalestra = this.idPalestra;
        this.idPalestra = idPalestra;
        changeSupport.firePropertyChange("idPalestra", oldIdPalestra, idPalestra);
    }

    public Ouvinte getIdOuvinte() {
        return idOuvinte;
    }

    public void setIdOuvinte(Ouvinte idOuvinte) {
        Ouvinte oldIdOuvinte = this.idOuvinte;
        this.idOuvinte = idOuvinte;
        changeSupport.firePropertyChange("idOuvinte", oldIdOuvinte, idOuvinte);
    }

    @Override
    public int hashCode() {
        int hash = 0;
        hash += (idSessao != null ? idSessao.hashCode() : 0);
        return hash;
    }

    @Override
    public boolean equals(Object object) {
        // TODO: Warning - this method won't work in the case the id fields are not set
        if (!(object instanceof Sessao)) {
            return false;
        }
        Sessao other = (Sessao) object;
        if ((this.idSessao == null && other.idSessao != null) || (this.idSessao != null && !this.idSessao.equals(other.idSessao))) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "model.Sessao[ idSessao=" + idSessao + " ]";
    }

    public void addPropertyChangeListener(PropertyChangeListener listener) {
        changeSupport.addPropertyChangeListener(listener);
    }

    public void removePropertyChangeListener(PropertyChangeListener listener) {
        changeSupport.removePropertyChangeListener(listener);
    }
    
}
