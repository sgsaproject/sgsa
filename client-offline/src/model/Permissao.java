/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import java.io.Serializable;
import javax.persistence.*;
import javax.xml.bind.annotation.XmlRootElement;

/**
 *
 * @author nasser
 */
@Entity
@Table(name = "PERMISSAO")
@XmlRootElement
@NamedQueries({
    @NamedQuery(name = "Permissao.findAll", query = "SELECT p FROM Permissao p"),
    @NamedQuery(name = "Permissao.findByIdPermissao", query = "SELECT p FROM Permissao p WHERE p.idPermissao = :idPermissao")})
public class Permissao implements Serializable {
    private static final long serialVersionUID = 1L;
    @Id
    @Basic(optional = false)
    @Column(name = "ID_PERMISSAO")
    private Integer idPermissao;
    @JoinColumn(name = "ID_USUARIO", referencedColumnName = "ID_USUARIO")
    @ManyToOne(optional = false)
    private Usuario idUsuario;
    @JoinColumn(name = "ID_PALESTRA", referencedColumnName = "ID_PALESTRA")
    @ManyToOne(optional = false)
    private Palestra idPalestra;

    public Permissao() {
    }

    public Permissao(Integer idPermissao) {
        this.idPermissao = idPermissao;
    }

    public Integer getIdPermissao() {
        return idPermissao;
    }

    public void setIdPermissao(Integer idPermissao) {
        this.idPermissao = idPermissao;
    }

    public Usuario getIdUsuario() {
        return idUsuario;
    }

    public void setIdUsuario(Usuario idUsuario) {
        this.idUsuario = idUsuario;
    }

    public Palestra getIdPalestra() {
        return idPalestra;
    }

    public void setIdPalestra(Palestra idPalestra) {
        this.idPalestra = idPalestra;
    }

    @Override
    public int hashCode() {
        int hash = 0;
        hash += (idPermissao != null ? idPermissao.hashCode() : 0);
        return hash;
    }

    @Override
    public boolean equals(Object object) {
        // TODO: Warning - this method won't work in the case the id fields are not set
        if (!(object instanceof Permissao)) {
            return false;
        }
        Permissao other = (Permissao) object;
        if ((this.idPermissao == null && other.idPermissao != null) || (this.idPermissao != null && !this.idPermissao.equals(other.idPermissao))) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "model.Permissao[ idPermissao=" + idPermissao + " ]";
    }
    
}
