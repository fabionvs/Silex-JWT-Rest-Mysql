Projeto

Instalação
------------
Para acessar a aplicação, basta colocar o projeto em uma pasta desejada, acessar a pasta "/web" e rodar o comando:
php -S localhost:8000

Após rodar o comando, acesse o endereço localhost:8000 no seu navegador. Irá abrir o front-end que foi criado para testar.

Endereços para o Rest:

Login: api/v1/login?user=fabio&pass=123

Carros:
- Listar: /api/v1/cars/ (get) 
- Editar: /api/v1/cars/edit/{id} (post)
- Inserir: /api/v1/cars/new (post)
- Deletar: /api/v1/cars/{id} (delete)

Parts:
- Partes/carro:  /api/v1/parts/{carro} (get) {carro} = Id do carro
- Inserir:  /api/v1/parts/new/{carro} (post) {carro} = Id do carro
- Editar: /api/v1/parts/edit/{id} } (post) {id} = Id da part
- Delete: /api/v1/parts/{id} (delete) {id} = Id da part
