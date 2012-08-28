package view;

import java.util.Date;
import java.util.logging.Level;
import model.Ouvinte;
import model.OuvinteException;
import model.Palestra;
import org.apache.log4j.Logger;
import util.Data;
import util.DataException;

/**
 *
 * @author thiago
 */
public class Sessao extends javax.swing.JFrame {
    
    public static Logger logger = Logger.getLogger(Sessao.class);
    private Palestra palestra;
    private Relogio relogio;

    /**
     * Creates new form Sessao
     */
    public Sessao(Palestra palestra) {
        initComponents();
        this.palestra = palestra;
        Ouvinte ouvinte = new Ouvinte();
        try {
            ouvinte.setCodigoBarras(12345);
        } catch (OuvinteException ex) {
            java.util.logging.Logger.getLogger(Sessao.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        model.Sessao sessao = new model.Sessao();
        sessao.setHoraEntrada(Data.getCurrentTime());
        sessao.setHoraSaida(Data.getCurrentTime());
        sessao.setOuvinte(ouvinte);
        
        this.sessoes.add(sessao);
        
        jlblNomePalestra.setText(palestra.getNome());
        jlblHoraInicioHora.setText(palestra.getHoraInicio());
        jlblHoraTerminoHora.setText(palestra.getHoraFim());
        jlblHoraInicioPrevistaHora.setText(palestra.getHoraInicioPrevista());
        jlblHoraTerminoPrevistoHora.setText(palestra.getHoraFimPrevista());
        
        relogio = new Relogio();
        relogio.start();
    }

    /**
     * This method is called from within the constructor to initialize the form.
     * WARNING: Do NOT modify this code. The content of this method is always
     * regenerated by the Form Editor.
     */
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {
        bindingGroup = new org.jdesktop.beansbinding.BindingGroup();

        sessoes = new java.util.ArrayList<model.Sessao>();
        jpnlSessao = new javax.swing.JPanel();
        jlblNomePalestra = new javax.swing.JLabel();
        jbtnAdd = new javax.swing.JButton();
        jlblInformeCodigoBarras = new javax.swing.JLabel();
        jlblTempoDecorrido = new javax.swing.JLabel();
        jbtnIniciarPalestra = new javax.swing.JButton();
        jbtnFinalizarPalestra = new javax.swing.JButton();
        jScrollPane1 = new javax.swing.JScrollPane();
        jTblOuvintes = new javax.swing.JTable();
        jlblTempoDecorridoHora = new javax.swing.JLabel();
        jlblHoraInicio = new javax.swing.JLabel();
        jlblHoraInicioHora = new javax.swing.JLabel();
        jlblHoraTermino = new javax.swing.JLabel();
        jlblHoraTerminoHora = new javax.swing.JLabel();
        jlblOuvintes = new javax.swing.JLabel();
        jlblHoraInicioPrevista = new javax.swing.JLabel();
        jlblHoraInicioPrevistaHora = new javax.swing.JLabel();
        jlblHoraTerminoPrevista = new javax.swing.JLabel();
        jlblHoraTerminoPrevistoHora = new javax.swing.JLabel();
        jlblHoraAtual = new javax.swing.JLabel();
        jlblHoraAtualHora = new javax.swing.JLabel();
        jftfCodigoBarras = new javax.swing.JFormattedTextField();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);
        setTitle("Sessão");
        setName("frameSessao"); // NOI18N
        setPreferredSize(new java.awt.Dimension(1000, 700));
        setResizable(false);
        getContentPane().setLayout(null);

        jpnlSessao.setBackground(new java.awt.Color(250, 250, 250));
        jpnlSessao.setName(""); // NOI18N
        jpnlSessao.setPreferredSize(new java.awt.Dimension(1000, 700));
        jpnlSessao.setLayout(null);

        jlblNomePalestra.setFont(new java.awt.Font("Arial", 1, 48)); // NOI18N
        jlblNomePalestra.setText("Nome da palestra");
        jpnlSessao.add(jlblNomePalestra);
        jlblNomePalestra.setBounds(20, 10, 960, 58);

        jbtnAdd.setText("Add");
        jbtnAdd.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jbtnAddActionPerformed(evt);
            }
        });
        jpnlSessao.add(jbtnAdd);
        jbtnAdd.setBounds(730, 160, 150, 60);

        jlblInformeCodigoBarras.setFont(new java.awt.Font("Tahoma", 0, 20)); // NOI18N
        jlblInformeCodigoBarras.setText("Informe o código de barras:");
        jpnlSessao.add(jlblInformeCodigoBarras);
        jlblInformeCodigoBarras.setBounds(450, 130, 248, 25);

        jlblTempoDecorrido.setFont(new java.awt.Font("Tahoma", 0, 20)); // NOI18N
        jlblTempoDecorrido.setText("Tempo decorrido da palestra:");
        jpnlSessao.add(jlblTempoDecorrido);
        jlblTempoDecorrido.setBounds(450, 470, 280, 30);

        jbtnIniciarPalestra.setText("Iniciar Palestra");
        jpnlSessao.add(jbtnIniciarPalestra);
        jbtnIniciarPalestra.setBounds(20, 80, 170, 40);

        jbtnFinalizarPalestra.setText("Finalizar Palestra");
        jpnlSessao.add(jbtnFinalizarPalestra);
        jbtnFinalizarPalestra.setBounds(250, 80, 170, 40);

        jScrollPane1.setFont(new java.awt.Font("Tahoma", 0, 14)); // NOI18N

        jTblOuvintes.setFont(new java.awt.Font("Tahoma", 0, 18)); // NOI18N
        jTblOuvintes.setForeground(new java.awt.Color(0, 125, 0));
        jTblOuvintes.setRowHeight(24);
        jTblOuvintes.setRowMargin(4);
        jTblOuvintes.setRowSelectionAllowed(false);
        jTblOuvintes.getTableHeader().setResizingAllowed(false);
        jTblOuvintes.getTableHeader().setReorderingAllowed(false);

        org.jdesktop.swingbinding.JTableBinding jTableBinding = org.jdesktop.swingbinding.SwingBindings.createJTableBinding(org.jdesktop.beansbinding.AutoBinding.UpdateStrategy.READ, sessoes, jTblOuvintes, "sessoes");
        org.jdesktop.swingbinding.JTableBinding.ColumnBinding columnBinding = jTableBinding.addColumnBinding(org.jdesktop.beansbinding.ELProperty.create("${ouvinte}"));
        columnBinding.setColumnName("Ouvinte");
        columnBinding.setColumnClass(model.Ouvinte.class);
        columnBinding.setEditable(false);
        columnBinding = jTableBinding.addColumnBinding(org.jdesktop.beansbinding.ELProperty.create("${horaEntradaString}"));
        columnBinding.setColumnName("Hora Entrada String");
        columnBinding.setColumnClass(String.class);
        columnBinding.setEditable(false);
        columnBinding = jTableBinding.addColumnBinding(org.jdesktop.beansbinding.ELProperty.create("${horaSaidaString}"));
        columnBinding.setColumnName("Hora Saida String");
        columnBinding.setColumnClass(String.class);
        columnBinding.setEditable(false);
        bindingGroup.addBinding(jTableBinding);
        jTableBinding.bind();
        jScrollPane1.setViewportView(jTblOuvintes);
        jTblOuvintes.getColumnModel().getColumn(0).setResizable(false);
        jTblOuvintes.getColumnModel().getColumn(1).setResizable(false);
        jTblOuvintes.getColumnModel().getColumn(2).setResizable(false);

        jpnlSessao.add(jScrollPane1);
        jScrollPane1.setBounds(20, 160, 400, 390);

        jlblTempoDecorridoHora.setFont(new java.awt.Font("Arial", 1, 48)); // NOI18N
        jlblTempoDecorridoHora.setForeground(new java.awt.Color(0, 0, 125));
        jlblTempoDecorridoHora.setText("02:15:22");
        jpnlSessao.add(jlblTempoDecorridoHora);
        jlblTempoDecorridoHora.setBounds(450, 490, 200, 56);

        jlblHoraInicio.setFont(new java.awt.Font("Tahoma", 0, 20)); // NOI18N
        jlblHoraInicio.setText("Hora de início:");
        jpnlSessao.add(jlblHoraInicio);
        jlblHoraInicio.setBounds(450, 250, 153, 25);

        jlblHoraInicioHora.setFont(new java.awt.Font("Arial", 1, 48)); // NOI18N
        jlblHoraInicioHora.setForeground(new java.awt.Color(0, 125, 0));
        jlblHoraInicioHora.setText("08:03:51");
        jpnlSessao.add(jlblHoraInicioHora);
        jlblHoraInicioHora.setBounds(450, 270, 200, 56);

        jlblHoraTermino.setFont(new java.awt.Font("Tahoma", 0, 20)); // NOI18N
        jlblHoraTermino.setText("Hora de término:");
        jpnlSessao.add(jlblHoraTermino);
        jlblHoraTermino.setBounds(740, 250, 153, 25);

        jlblHoraTerminoHora.setFont(new java.awt.Font("Arial", 1, 48)); // NOI18N
        jlblHoraTerminoHora.setForeground(new java.awt.Color(125, 0, 0));
        jlblHoraTerminoHora.setText("::");
        jpnlSessao.add(jlblHoraTerminoHora);
        jlblHoraTerminoHora.setBounds(740, 270, 200, 56);

        jlblOuvintes.setFont(new java.awt.Font("Tahoma", 0, 20)); // NOI18N
        jlblOuvintes.setText("Ouvintes que estão ou estavam na palestra:");
        jpnlSessao.add(jlblOuvintes);
        jlblOuvintes.setBounds(20, 130, 395, 25);

        jlblHoraInicioPrevista.setFont(new java.awt.Font("Tahoma", 0, 20)); // NOI18N
        jlblHoraInicioPrevista.setText("Hora de início prevista:");
        jpnlSessao.add(jlblHoraInicioPrevista);
        jlblHoraInicioPrevista.setBounds(450, 360, 210, 25);

        jlblHoraInicioPrevistaHora.setFont(new java.awt.Font("Arial", 1, 48)); // NOI18N
        jlblHoraInicioPrevistaHora.setText("08:00:00");
        jpnlSessao.add(jlblHoraInicioPrevistaHora);
        jlblHoraInicioPrevistaHora.setBounds(450, 380, 200, 56);

        jlblHoraTerminoPrevista.setFont(new java.awt.Font("Tahoma", 0, 20)); // NOI18N
        jlblHoraTerminoPrevista.setText("Hora de término prevista:");
        jpnlSessao.add(jlblHoraTerminoPrevista);
        jlblHoraTerminoPrevista.setBounds(740, 360, 230, 25);

        jlblHoraTerminoPrevistoHora.setFont(new java.awt.Font("Arial", 1, 48)); // NOI18N
        jlblHoraTerminoPrevistoHora.setText("10:30:00");
        jpnlSessao.add(jlblHoraTerminoPrevistoHora);
        jlblHoraTerminoPrevistoHora.setBounds(740, 380, 210, 56);

        jlblHoraAtual.setFont(new java.awt.Font("Tahoma", 0, 20)); // NOI18N
        jlblHoraAtual.setText("Hora Atual:");
        jpnlSessao.add(jlblHoraAtual);
        jlblHoraAtual.setBounds(740, 470, 102, 30);

        jlblHoraAtualHora.setFont(new java.awt.Font("Arial", 1, 48)); // NOI18N
        jlblHoraAtualHora.setForeground(new java.awt.Color(0, 0, 125));
        jlblHoraAtualHora.setText("10:19:13");
        jpnlSessao.add(jlblHoraAtualHora);
        jlblHoraAtualHora.setBounds(740, 490, 210, 56);

        jftfCodigoBarras.setText("12345");
        jftfCodigoBarras.setFont(new java.awt.Font("Arial", 1, 48)); // NOI18N
        jpnlSessao.add(jftfCodigoBarras);
        jftfCodigoBarras.setBounds(450, 160, 270, 60);

        getContentPane().add(jpnlSessao);
        jpnlSessao.setBounds(0, 0, 1000, 600);

        bindingGroup.bind();

        pack();
    }// </editor-fold>//GEN-END:initComponents

    private void jbtnAddActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jbtnAddActionPerformed
        Ouvinte ouvinte = null;
        try {
            ouvinte = new Ouvinte();
            ouvinte.setCodigoBarras(Integer.parseInt(jftfCodigoBarras.getText()));
        } catch (OuvinteException ex) {
            java.util.logging.Logger.getLogger(Sessao.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        model.Sessao sessao = new model.Sessao();
        sessao.setOuvinte(ouvinte);
        sessao.setPalestra(palestra);
        sessao.setHoraEntrada(Data.getCurrentTime());
        palestra.addSessao(sessao);
    }//GEN-LAST:event_jbtnAddActionPerformed

    /**
     * @param args the command line arguments
     */
    public static void main(final Palestra palestra) {
        /* Set the Nimbus look and feel */
        //<editor-fold defaultstate="collapsed" desc=" Look and feel setting code (optional) ">
        /* If Nimbus (introduced in Java SE 6) is not available, stay with the default look and feel.
         * For details see http://download.oracle.com/javase/tutorial/uiswing/lookandfeel/plaf.html 
         */
        try {
            for (javax.swing.UIManager.LookAndFeelInfo info : javax.swing.UIManager.getInstalledLookAndFeels()) {
                if ("Nimbus".equals(info.getName())) {
                    javax.swing.UIManager.setLookAndFeel(info.getClassName());
                    break;
                }
            }
        } catch (ClassNotFoundException ex) {
            java.util.logging.Logger.getLogger(Sessao.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(Sessao.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(Sessao.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(Sessao.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                new Sessao(palestra).setVisible(true);
            }
        });
    }
    
    private class Relogio extends Thread {

        @Override
        public void run() {
            while (true) {
                try {
                    long time = System.currentTimeMillis();
                    Date hoje = new Date(time);
                    long tempoDecorrido = time - Data.getDataHora(Data.getDate(hoje), palestra.getHoraInicio()).getTime();
                    jlblHoraAtualHora.setText(Data.getTime(hoje));
                    jlblTempoDecorridoHora.setText(Data.getTime(new Date(tempoDecorrido)));
                    Relogio.sleep(250);
                } catch (InterruptedException|DataException ex) {
                    logger.fatal(ex);
                }
            }
        }
    }
    
    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JScrollPane jScrollPane1;
    private javax.swing.JTable jTblOuvintes;
    private javax.swing.JButton jbtnAdd;
    private javax.swing.JButton jbtnFinalizarPalestra;
    private javax.swing.JButton jbtnIniciarPalestra;
    private javax.swing.JFormattedTextField jftfCodigoBarras;
    private javax.swing.JLabel jlblHoraAtual;
    private javax.swing.JLabel jlblHoraAtualHora;
    private javax.swing.JLabel jlblHoraInicio;
    private javax.swing.JLabel jlblHoraInicioHora;
    private javax.swing.JLabel jlblHoraInicioPrevista;
    private javax.swing.JLabel jlblHoraInicioPrevistaHora;
    private javax.swing.JLabel jlblHoraTermino;
    private javax.swing.JLabel jlblHoraTerminoHora;
    private javax.swing.JLabel jlblHoraTerminoPrevista;
    private javax.swing.JLabel jlblHoraTerminoPrevistoHora;
    private javax.swing.JLabel jlblInformeCodigoBarras;
    private javax.swing.JLabel jlblNomePalestra;
    private javax.swing.JLabel jlblOuvintes;
    private javax.swing.JLabel jlblTempoDecorrido;
    private javax.swing.JLabel jlblTempoDecorridoHora;
    private javax.swing.JPanel jpnlSessao;
    private java.util.ArrayList<model.Sessao> sessoes;
    private org.jdesktop.beansbinding.BindingGroup bindingGroup;
    // End of variables declaration//GEN-END:variables
}