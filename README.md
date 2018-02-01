# CMS Desktop com PHP e Electron

## Como testar

Para testar este aplicativo baixe o código fonte e o instalador do aplicativo (apenas para Windows).

 - [Código fonte](https://github.com/schoolofnetcom/cms-electron-php/archive/master.zip)
 - [Aplicativo](https://github.com/schoolofnetcom/cms-electron-php/releases)

Descompacte o código fonte, e acesse o diretório `server`, instale as dependências (`composer install`).

Acesse o diretório `server/src/settings.php` e configure o banco de dados trocando os valores da linha 23 até a 30, crie o banco de dados no MySQL, não se preocupe com as tabelas, vamos cria-las automaticamente no próximo passo.

A partir deste ponto verifique se tem o PHP nas variáveis de ambiente, para tal rode o comando (na linha de comando, pode ser o PowerShell, CMD, GitBash, ou o que você preferir) `php -v` em qualquer diretório do computador.

De volta a raiz do diretório server, rode o comando (na linha de comando, pode ser o PowerShell, CMD, GitBash, ou o que você preferir) e rode as migrations no banco de dados usando o comando `vendor/bin/phinx migrate`, dependendo do cliente de linha de comando que estiver usando você pode precisar inverter as barras, ou seja `vendor\bin\phinx migrate`.

As tabelas serão criadas no banco de dados automáticamente.

Você vai precisar criar um usuário para acessar o aplicativo, esta feature está, ironicamente, protegida por senha, vá até o arquivo `server/src/middleware.php` e comente da linha 6 até a 20, deixe apenas o último middleware ativo, ele é importante.

Rode o servidor embutido do php, você precisa rodar exatamente assim, o aplicativo não reconhece outra URL, para segurança, o comando precisa ser feito dentro do diretório server, na raiz dele.

`php -S localhost:8000 -t public`

Instale o aplicativo com duplo clique, ele irá abrir automáticamente no final da instalação.

No terceiro botão da lateral direita (usuários) inclua um novo (use o botão **+**).

Fecha o aplicativo, volte no arquivo `server/src/middleware.php` e descomente da linha 6 até a 20.

Abra o aplicativo, agora protegido com usuário e senha no servidor (mais seguro) e boa brincadeira.
