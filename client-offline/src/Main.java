
import model.Palestra;
import util.Data;
import view.Sessao;

/**
 *
 * @author thiago
 */
public class Main {
    public static void main(String[] args) {
        String dataPalestra = Data.getDate(Data.getCurrentTime());
        Palestra palestra = new Palestra();
        palestra.setId(1);
        palestra.setNome("Palestra sobre algo interessante mas com nome grande");
        palestra.setInstituicao("UNIPAMPA");
        palestra.setPalestrante("Algum professor");
        palestra.setSala("101");
        palestra.setHoraFim(dataPalestra, "15:31:43");
        palestra.setHoraFimPrevista(dataPalestra, "15:30:00");
        palestra.setHoraInicio(dataPalestra, "13:34:11");
        palestra.setHoraInicioPrevista(dataPalestra, "13:30:00");
        Sessao.main(palestra);
    }
}
