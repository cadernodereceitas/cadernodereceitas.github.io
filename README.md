# Caderno de Receitas

Projeto inicializado na disciplina de Programação para a Web, no curso de Sistemas de Informação da Universidade Federal de Santa Catarina no semestre 2021.1.

O projeto trata-se de um portal para servir como repositório pessoal e rede social de compartilhamento de receitas.

Inicialmente foi desenvolvido utilizando HTML, CSS e JavaScript.

https://cadernodereceitas.github.io

Posteriormente o projeto foi reimaginado utilizando PHP e Laravel, finalizando as etapas que não puderam ser desenvolvidas no decorrer da disciplina.

Para executar o projeto realize os seguintes passos:

1. Instale o PHP (foi utilizada a versão 8.2.11 no desenvolvimento do projeto);
2. Instale o Composer (foi utilizada a versão 2.6.5 no desenvolvimento do projeto);
3. Faça o clone do projeto;
4. Abra a pasta "CadernoDeReceitas" no promp de comando;
5. Execute o comando "composer install" para instalação das dependências do projeto, esse passo pode demorar um pouco;
6. Instale o MySQL;
7. Crie um databese no MySQL;
8. Configure o arquivo .env para acesso ao banco de dados (em especial: DB_PORT, DB_DATABASE, DB_USERNAME e DB_PASSWORD);
9. Execute o comando "php artisan migrate" para executar as migrations
10. Instale o Redis;
11. Configure o arquivo .env para acesso ao redis (em especial: REDIS_HOST, REDIS_PASSWORD, REDIS_PORT, REDIS_CLIENT);
12. Execute o comando "php artisan serve" para servir a aplicação
13. Acesse o endereço "http://localhost:8000"
