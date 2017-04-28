Projeto Silex com Rest e autenticação JWT

Instalação
------------
Abra o arquivo "fabio.sql" e rode em seu banco de dados.

Altere as configurações do banco no arquivo app/config/parameters.yml

Instale as dependências do composer
- php composer.phar install

Para acessar a aplicação, basta colocar o projeto em uma pasta desejada, acessar a pasta "/web" e rodar o comando:
- php -S localhost:8000

Após rodar o comando, acesse o endereço localhost:8000 no seu navegador. Irá abrir o front-end que foi criado para testar.

Endereços para o Rest:

Login: http://localhost:8000/api/v1/login?user=fabio&pass=123

Carros:
- Listar: /api/v1/cars/ (get) 
- Editar: /api/v1/cars/edit/{id} (post)
- Inserir: /api/v1/cars/new (post)
- Deletar: /api/v1/cars/{id} (delete)

Parts:
- Partes/carro:  /api/v1/parts/{carro} - (get) {carro} = Id do carro
- Inserir:  /api/v1/parts/new/{carro} - (post) {carro} = Id do carro
- Editar: /api/v1/parts/edit/{id} } - (post) {id} = Id da part
- Delete: /api/v1/parts/{id} - (delete) {id} = Id da part

Exemplo: http://localhost:8000/api/v1/cars

Se for utilizar via Postman, ou algum cliente Rest, lembre-se de usar o header:
- "Autorization" "Bearer (TOKEN)"

Requisitos:
php >= 7.0
