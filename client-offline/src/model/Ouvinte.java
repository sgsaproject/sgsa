package model;

import java.util.ArrayList;
import java.util.Collection;
import org.apache.log4j.Logger;

/**
 *
 * @author thiago
 */
public class Ouvinte {
    
    public static Logger logger = Logger.getLogger(Ouvinte.class);
    
    private int id;
    private String nome;
    private String rg;
    private String email;
    private String curso;
    private String instituicao;
    private String pagamento;
    private boolean impresso;
    private int codigoBarras;
    private ArrayList<Sessao> sessoes;

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
     * @return the rg
     */
    public String getRg() {
        return rg;
    }

    /**
     * @param rg the rg to set
     */
    public void setRg(String rg) {
        this.rg = rg;
    }

    /**
     * @return the email
     */
    public String getEmail() {
        return email;
    }

    /**
     * @param email the email to set
     */
    public void setEmail(String email) {
        this.email = email;
    }

    /**
     * @return the curso
     */
    public String getCurso() {
        return curso;
    }

    /**
     * @param curso the curso to set
     */
    public void setCurso(String curso) {
        this.curso = curso;
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
     * @return the pagamento
     */
    public String getPagamento() {
        return pagamento;
    }

    /**
     * @param pagamento the pagamento to set
     */
    public void setPagamento(String pagamento) {
        this.pagamento = pagamento;
    }
    
    public boolean isImpresso() {
        return this.impresso;
    }

    public void setImpresso(boolean impresso) {
        this.impresso = impresso;
    }

    public int getCodigoBarras() {
        return this.codigoBarras;
    }

    public void setCodigoBarras(int codigoBarras) throws OuvinteException {
        int tamanho = 5;
        if (String.valueOf(codigoBarras).length() != tamanho) {
            throw new OuvinteException("Tamanho do código de barras incorreto. Tamanho informado: " + String.valueOf(codigoBarras).length() + ". Tamanho correto: " + tamanho);
        } else if (codigoBarras < 0) {
            throw new OuvinteException("Código de barras inválido. O código de barras deve ser maior ou igual a 0.");
        } else {
            this.codigoBarras = codigoBarras;
        }
    }

    /**
     * @return the sessoes
     */
    public ArrayList<Sessao> getSessoes() {
        return sessoes;
    }

    /**
     * @param sessoes the sessoes to set
     */
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
