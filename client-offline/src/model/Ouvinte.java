/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import java.io.Serializable;
import java.util.List;
import javax.persistence.*;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlTransient;

/**
 *
 * @author nasser
 */
@Entity
@Table(name = "OUVINTE")
@XmlRootElement
@NamedQueries({
    @NamedQuery(name = "Ouvinte.findAll", query = "SELECT o FROM Ouvinte o"),
    @NamedQuery(name = "Ouvinte.findByIdOuvinte", query = "SELECT o FROM Ouvinte o WHERE o.idOuvinte = :idOuvinte"),
    @NamedQuery(name = "Ouvinte.findByNome", query = "SELECT o FROM Ouvinte o WHERE o.nome = :nome"),
    @NamedQuery(name = "Ouvinte.findByRg", query = "SELECT o FROM Ouvinte o WHERE o.rg = :rg"),
    @NamedQuery(name = "Ouvinte.findByEmail", query = "SELECT o FROM Ouvinte o WHERE o.email = :email"),
    @NamedQuery(name = "Ouvinte.findByCurso", query = "SELECT o FROM Ouvinte o WHERE o.curso = :curso"),
    @NamedQuery(name = "Ouvinte.findByInstituicao", query = "SELECT o FROM Ouvinte o WHERE o.instituicao = :instituicao"),
    @NamedQuery(name = "Ouvinte.findByPagamento", query = "SELECT o FROM Ouvinte o WHERE o.pagamento = :pagamento"),
    @NamedQuery(name = "Ouvinte.findByImpresso", query = "SELECT o FROM Ouvinte o WHERE o.impresso = :impresso"),
    @NamedQuery(name = "Ouvinte.findByCodigoBarras", query = "SELECT o FROM Ouvinte o WHERE o.codigoBarras = :codigoBarras")})
public class Ouvinte implements Serializable {
    private static final long serialVersionUID = 1L;
    @Id
    @Basic(optional = false)
    @Column(name = "ID_OUVINTE")
    private Integer idOuvinte;
    @Column(name = "NOME")
    private String nome;
    @Column(name = "RG")
    private String rg;
    @Column(name = "EMAIL")
    private String email;
    @Column(name = "CURSO")
    private String curso;
    @Column(name = "INSTITUICAO")
    private String instituicao;
    @Column(name = "PAGAMENTO")
    private String pagamento;
    @Column(name = "IMPRESSO")
    private Integer impresso;
    @Basic(optional = false)
    @Column(name = "CODIGO_BARRAS")
    private String codigoBarras;
    @OneToMany(cascade = CascadeType.ALL, mappedBy = "idOuvinte")
    private List<Sessao> sessaoList;

    public Ouvinte() {
    }

    public Ouvinte(Integer idOuvinte) {
        this.idOuvinte = idOuvinte;
    }

    public Ouvinte(Integer idOuvinte, String codigoBarras) {
        this.idOuvinte = idOuvinte;
        this.codigoBarras = codigoBarras;
    }

    public Integer getIdOuvinte() {
        return idOuvinte;
    }

    public void setIdOuvinte(Integer idOuvinte) {
        this.idOuvinte = idOuvinte;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getRg() {
        return rg;
    }

    public void setRg(String rg) {
        this.rg = rg;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getCurso() {
        return curso;
    }

    public void setCurso(String curso) {
        this.curso = curso;
    }

    public String getInstituicao() {
        return instituicao;
    }

    public void setInstituicao(String instituicao) {
        this.instituicao = instituicao;
    }

    public String getPagamento() {
        return pagamento;
    }

    public void setPagamento(String pagamento) {
        this.pagamento = pagamento;
    }

    public Integer getImpresso() {
        return impresso;
    }

    public void setImpresso(Integer impresso) {
        this.impresso = impresso;
    }

    public String getCodigoBarras() {
        return codigoBarras;
    }

    public void setCodigoBarras(String codigoBarras) {
        this.codigoBarras = codigoBarras;
    }

    @XmlTransient
    public List<Sessao> getSessaoList() {
        return sessaoList;
    }

    public void setSessaoList(List<Sessao> sessaoList) {
        this.sessaoList = sessaoList;
    }

    @Override
    public int hashCode() {
        int hash = 0;
        hash += (idOuvinte != null ? idOuvinte.hashCode() : 0);
        return hash;
    }

    @Override
    public boolean equals(Object object) {
        // TODO: Warning - this method won't work in the case the id fields are not set
        if (!(object instanceof Ouvinte)) {
            return false;
        }
        Ouvinte other = (Ouvinte) object;
        if ((this.idOuvinte == null && other.idOuvinte != null) || (this.idOuvinte != null && !this.idOuvinte.equals(other.idOuvinte))) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "model.Ouvinte[ idOuvinte=" + idOuvinte + " ]";
    }
    
}
