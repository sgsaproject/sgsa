-- primeiro veja se as foreing keys jah naum estao cascade. se naum estao pode executar esse sql.
alter table permissao drop foreign key fk_usuario_palestra_usuario1;
alter table permissao add constraint fk_usuario_palestra_usuario1 foreign key (id_usuario) references usuario(id_usuario) on delete cascade on update no action;

alter table permissao drop foreign key fk_usuario_palestra_palestra1;
alter table permissao add constraint fk_usuario_palestra_palestra1 foreign key (id_palestra) references palestra(id_palestra) on delete cascade on update no action;
