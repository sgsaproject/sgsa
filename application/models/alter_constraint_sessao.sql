-- primeiro veja se as foreing keys jah naum estao cascade. se naum estao pode executar esse sql.
alter table sessao drop foreign key fk_sessao_ouvinte2;
alter table sessao add constraint fk_sessao_ouvinte2 foreign key (id_ouvinte) references ouvinte(id_ouvinte) on delete cascade on update no action;
