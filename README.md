# Gerenciador de Tarefas

Projeto simples de um gerenciador de tarefas feito em PHP, MySQL e HTML/CSS, com integração de SweetAlert para confirmações.

---

## Recursos

- Listagem de tarefas
- Adicionar, editar e excluir tarefas
- Confirmação visual para exclusão usando SweetAlert
- Exibição do nome do usuário logado

---

## Estrutura do Projeto

- `/img` - Contém a logo do sistema (`logo.png`)
- `/style` - Arquivos CSS estilizados com as cores do projeto
- `inicio.php` - Página principal que lista tarefas
- `editar_tarefa.php` - Página para editar tarefas
- `excluir_tarefa.php` - Script para exclusão de tarefas
- `config.php` - Configurações de conexão com o banco de dados

---

## Cores Utilizadas

- Roxo escuro: `#520283`
- Roxo vibrante: `#9d00ff`

Essas cores são usadas para backgrounds, bordas, botões e efeitos visuais, mantendo a identidade visual consistente.

---

## Logo

A logo do projeto está localizada na pasta `/img` com o nome `logo.png`. Ela aparece no topo da aplicação, dentro da barra de navegação.

---

## Como Usar

1. Configure seu banco de dados no arquivo `config.php`.
2. Importe o banco com a tabela `tarefas` (estrutura simples com campos para descrição, prioridade, setor, data, status e fk_usuario_id).
3. Suba os arquivos no seu servidor local (ex: XAMPP).
4. Acesse `inicio.php` para começar a gerenciar suas tarefas.

---

## Dependências

- PHP 7.x ou superior
- MySQL
- SweetAlert2 (via CDN)

---

## Contato

Para dúvidas ou sugestões, entre em contato.

---

**Desenvolvido por Kaique Ferreira**