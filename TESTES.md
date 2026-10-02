# 15 casos de teste

Use a aplicação pelo servidor Apache (por exemplo, `http://localhost/nome-da-pasta/`).

| # | Funcionalidade | Cenário | Resultado esperado |
|---|---|---|---|
| 1 | Cadastrar | Adicionar `Estudar` | A tarefa aparece na lista. |
| 2 | Cadastrar | Adicionar `Comprar pão` | A nova tarefa aparece na lista. |
| 3 | Cadastrar | Tentar adicionar sem texto | A aplicação informa que é preciso informar uma tarefa. |
| 4 | Listar | Abrir a página sem tarefas | A mensagem de lista vazia é exibida. |
| 5 | Listar | Adicionar uma tarefa e recarregar a página | A tarefa continua na lista. |
| 6 | Listar | Adicionar duas tarefas | As duas tarefas aparecem na lista. |
| 7 | Concluir | Marcar uma tarefa pendente | Ela fica riscada e o total de concluídas aumenta. |
| 8 | Concluir | Desmarcar uma tarefa concluída | Ela volta a ficar pendente. |
| 9 | Concluir | Concluir duas tarefas | O resumo mostra `2 concluídas`. |
| 10 | Editar | Alterar `Estudar` para `Estudar matemática` | O novo texto aparece na lista. |
| 11 | Editar | Tentar salvar uma edição vazia | A aplicação informa que o título não pode ficar vazio. |
| 12 | Editar | Cancelar a caixa de edição | O texto da tarefa não é alterado. |
| 13 | Excluir | Excluir uma tarefa e confirmar | A tarefa desaparece da lista. |
| 14 | Excluir | Cancelar a confirmação de exclusão | A tarefa permanece na lista. |
| 15 | Excluir | Excluir a última tarefa | A mensagem de lista vazia é exibida. |
