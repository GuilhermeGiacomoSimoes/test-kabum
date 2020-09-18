# teste kabum

	1 - Uma área administrativa onde o(s) usuário(s) devem acessar através de login e senha.

	2 - Criar um gerenciador de clientes (Listar, Incluir, Editar e Excluir)

		2.1 - O cadastro do Cliente deve conter: Nome; Data Nascimento;CPF; RG; Telefone.
		2.2 - O Cliente pode ter 1 ou N endereços.


## crie o bd e as tabelas
	- rode o arquivo db.sql que está na raiz do projeto no seu sgdb preferido
 
	- caso queira rodar pelo shell... é o seguinte
	----------------------------------------------------------------- - x 
	|	$ mysql -u root -p												|
	|																	|
	|	- digite sua senha do mysql										|
	|																	|
	|	$ create database administrative_area;						    |
	|	$ exit															|
	|																	|
	|	$ mysql -u root -p administrative_area < caminho/do/bd.sql		|
	|																	|
	|	FEITO :)														|
	|--------------------------------------------------------------------


## execute na porta 8080
	php -S localhost:8080
