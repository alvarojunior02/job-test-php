# Desafio Técnico com PHP puro
Aplicação Full Stack, com PHP no backend + frontend básico (HTML, CSS, JS/jQuery) + banco de dados MySQL
<br><br>
Principais problemas a serem resolvidos:
- Importação de dados de clientes via planilhas de Excel (.csv, escolhido pelo dev);
- Gestão dos cadastros de clientes e pedidos;
- Envio de e-mails para os clientes (manuais ou automáticos);
- Importação de arquivo XML afim de conseguir manipular, no PHP, esse formato de arquivo.

<br>

Conceitos que foram aplicados:
- Arquitetura Model-View-Controller (MVC);
- Programação Orientada a Objetos (Classes, Objetos, Herança, Encapsulamento...);
- PSR-4 (Namespaces), para reaproveitar Classes (Códigos) em outras partes da aplicação.

## Pacotes do Composer usados:
- PHPMailer (https://github.com/PHPMailer/PHPMailer);
- PHPDotEnv (https://github.com/vlucas/phpdotenv);

## Para rodar localmente

Requerimentos:
- PHP ^8.2.12;
- Composer ^2.7.1;
- Apache ^2.4.58;
- MySQL = MariaDB (10.4.32).

Usei o XAMPP para o Servidor Apache e MariaDB(MySQL);

- Para configurar a aplicação inicialmente:
```
git clone https://github.com/alvarojunior02/job-test-php.git
```
```
cd job-test-php
```
```
composer install
```
```
composer dump-autoload
```

## Demais configurações e informações úteis

O arquivo .env.example contém todas as variáveis de ambientes usadas nessa aplicação:
- Para conexão com o banco de dados MySQL (padrão localhost:3306, root, '');
- Para configuração do servidor SMTP (usei o https://mailtrap.io/ para testes);

Existe 1 arquivo de backup da estrutura do banco de dados em: ./job-test-php/database/dump_loja_magica_db.sql

Existem 2 arquivos de exemplo para importação na pasta ./filesExample:
- Clientes.csv (formato definido para as planilhas de Excel);
- Pedidos.xml (todos os atributos são fictícios);

Observação: Quanto à importação de XML, não salvei no banco, apenas exibi os dados para o usuário no front.

É possível configurar um VHost para a aplicação rodar localmente. Mas, ainda assim, para testar de modo mais rápido, é possível usar:
```
php -S localhost:8080 -t ./public
```

## Frontend
Ao iniciar a aplicação na rota "/" terão duas opções:
- Clientes;
- Pedidos.

### Quanto aos Clientes
- É possível Importar Cliente pelo Arquivo CSV;
- Cadastrar manualmente com: CPF, nome e e-mail;
- Editar o nome e/ou e-mail;
- Enviar e-mails diretamente;
- Visualizar os Pedidos e Emails de um usuário específico.

### Quanto aos Pedidos
- É possível Importar o Arquivo XML para exibir as informações no frontend;
- Registrar manualmente definindo: Cliente, Valor e Status do Pedido (o que gera envio de e-mail informando o novo pedido);
- Editar o status (o que gera e-mails informando a atualização do status);

## Considerações e Feedback pessoal
Pude chegar a conclusão de que, o uso de frameworks facilita sim o desenvolvimento web, porém, 
ao nos deparar-mos com problemas mais lógicos e de pura linguagem de programação, onde o conhecimento afundo da linguagem  
serve de base para encontrar uma solução, podemos acabar nos sentindo despreparados.

<br>

Quando iniciei esse desafio quis dar mais do que o necessário para passar uma imagem de pró-atividade e capacidade técnica.

<br>

Mas, a frase "planejamento de mais é sinônimo de procastinação", fez muito sentido nessa última semana.

<br>

Iniciei em uma segunda no fim da tarde, organizei tasks em um Kanban com alguns detalhamentos inciais que imaginei, 
prototipei uma interface gráfica no figma (que só aproveitei o esquema de cores hehehe) e, querendo ou não, quebrei bastante a cabeça para definir
a estrutura de pastas, PSR que seria usada. Virei algumas noites onde minha produtidade aumentou muito, deixava de lado o planejamento raso e "codava" de fato o que precisava.

<br>

Hoje (11/03/2024), uma semana depois do início do desafio, estou bem contente com meu resultado. Consegui focar nas funcionalidades essenciais e ainda estilizei de forma simples as páginas web.
Levarei como aprendizado o fato de que, seguir todos os passos do desenvolvimento de um software é importante, mas, na prática, a teoria acaba sendo aplicada "ligeiramente" diferente, ainda mais em projetos solos.

## Pontos de melhoria na minha aplicação
- Testes unitários e de integração;
- Contêiners com Docker, para o banco de dados e servidor Apache;
- Arquitetura Pub/Sub (orientação a eventos, para envio de e-mails), mais robusta e desacoplada.
