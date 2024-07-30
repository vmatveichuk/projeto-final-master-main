--Inserir situacao
INSERT INTO situacao_cadastro (descricao) VALUES ('ATIVO'), ('EXCLUIDO');
--Inserir tipo usuario
insert into tipo_usuario (descricao) values ('Atleta'), ('Professor'), ('Avaliador Físico');;
--Inserir Usuario Atleta;
insert into usuarios (nome, usuario, senha, idtipo, idsituacao) VALUES ('Thiago', 'thiago', '202cb962ac59075b964b07152d234b70', 1,1);
--Inserir Usuario Professor;
insert into usuarios (nome, usuario, senha, idtipo, idsituacao) VALUES ('Professor', 'professor', '202cb962ac59075b964b07152d234b70', 2,1)
-- Inserir Exercicios 
INSERT INTO exercicios (nome, urlvideo) VALUES ('Leg Press', 'https://www.youtube.com/embed/G451bUiQFEA');
-- Inserir Treinos Treino de perna = 1 || Treino de Braco == 2
INSERT INTO treinos (nome, idusuario) VALUES ('TREINO DE BRAÇO', 1);
-- Inserir Exercicios no Treino
INSERT INTO treinos_exercicios (idtreino,idexercicio, qnt_repeticoes, repeticoes) VALUES (2,1,3,8);