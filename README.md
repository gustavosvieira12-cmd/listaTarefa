# Lista simples de tarefas

Projeto web em PHP com banco de dados MySQL/MariaDB, que pode ser gerenciado pelo phpMyAdmin.

## Cinco requisitos atendidos

1. Cadastrar uma tarefa.
2. Listar as tarefas salvas.
3. Marcar uma tarefa como concluída ou pendente.
4. Editar o título de uma tarefa.
5. Excluir uma tarefa.

Os dados são armazenados no banco `tarefas_simples`, na tabela `tarefas`.

Cada requisito possui três casos de teste, totalizando 15. Consulte [TESTES.md](TESTES.md).

## Como usar com phpMyAdmin

1. Abra o phpMyAdmin e clique em **Importar**.
2. Escolha o arquivo [banco.sql](banco.sql) e clique em **Importar/Executar**. Ele cria o banco e a tabela.
3. Confira o arquivo `config.php`. Para o XAMPP padrão, os valores já estão certos: usuário `root` e senha vazia.
4. Coloque esta pasta dentro de `htdocs` (XAMPP) ou `www` (WampServer).
5. Abra `http://localhost/nome-da-pasta/` no navegador.

O código PHP está concentrado em `index.php`, e a conexão com MySQL em `conexao.php`.
