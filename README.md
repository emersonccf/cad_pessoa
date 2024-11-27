<center><img alt="cadastro_pessoas.png" height="80" src="resources%2Fimgs%2Fcadastro_pessoas.png" width="80"/></center>

# Documentação sobre o uso do Cadastro de Pessoas no Tinker do Laravel 11 através do Eloquent ORM


## Configuração do ambiente
- Verifique se o ``Composer ``está instalado (gerenciador de pacotes PHP);
- Verifique se o ``Node`` está instalado (gerenciador de pacotes JavaScript)
- Verifique se o ``Xampp`` ou ``Wamp`` está instalado com a versão do ``PHP 8.1`` ou superior junto com o banco de dados ``MySQL/MariaDB 5.5`` e o ``Apache``;
- Verifique se o ``Git`` está instalado;
- Se desejar opte por baixar e instalar a versão full do prompt de comando ``Cmder`` (ajuda bastante no Windows) https://cmder.app/ ;

## Passos para a implantação do sistema:
1. **Baixe a aplicação do repositório através do comando:**
```
git clone https://github.com/emersonccf/cad_pessoa.git
```
2. **Abra o arquivo php.ini, localizado em ``C:\xampp\php\php.ini`` ou no caminho onde esteja localizado seu ``php.ini ``para saber o caminho digite:**
```
where php.ini (Windows) 
which php.ini (IOS ou Linux)
```
2.1. **Encontre as linhas correspondentes às extensões SOAP, GD e demais citadas abaixo, geralmente comentadas. Remova o ponto e vírgula (;) no início dessas linhas para ativar as extensões:**
```
;extension=soap
;extension=gd
;extension=fileinfo
;extension=pdo_mysql
;extension=mysqli
```
2.2. **Salve o arquivo php.ini e reinicie o servidor ``Apache`` no ``XAMPP``.**

5.**De dentro da pasta do projeto ``cad_pessoa\``  execute os comandos a seguir**

5.1.**Instalar as dependências dos pacotes PHP, a pasta `vendor\` será criada com os pacotes que serão baixados:**
```
composer install
```
5.2. **Instalar as dependências dos pacotes `JavaScript`, a pasta `node_modules\` será criada com os pacotes que serão baixados:**
```
npm install && npm run build
```
6.**Crie o banco de dados no `MySql`:**

6.1. **Abra o terminal (ou prompt de comando) e entre no `MySQL` com seu usuário e senha:**
```
mysql -u root -p <senha_se_hover>
```
6.2. **Crie o banco de dados `cad_pessoa`:**
```
CREATE DATABASE cad_pessoa;
```
6.3. **Verifique se o banco foi criado (opcional)**
```
SHOW DATABASES;
```
6.4. **Sair do MySQL:**
```
EXIT;
```
7. **Configure o arquivo `.env`:**

7.1. **Crie uma cópia do arquivo `.env.example` e renomei para como `.env`**

7.2. **Altere as configurações de banco de dados MySql para as credenciais de seu banco, que deve ficar mais ou menos assim, ou de acordo com seu ambiente:**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cad_pessoa
DB_CHARSET=utf8
DB_COLLATION=utf8_general_ci
DB_USERNAME=root
DB_PASSWORD=
```
7.3. **Para ajustar o Laravel a aplicação no Brasil deve-se definir as configurações apropriadas para o idioma e região brasileiros através da configuração dessas chaves:**
```
APP_LOCALE=pt_BR
APP_FALLBACK_LOCALE=pt_BR
APP_FAKER_LOCALE=pt_BR
APP_TIMEZONE=America/Sao_Paulo
```
7.4 **Gere uma nova chave para a aplicação e automaticamente a insere no arquivo .`env` na variável `APP_KEY`:**
```
php artisan key:generate 
```
8. **Após fazer alterações no arquivo .`env` , é uma boa prática limpar o cache de configurações para garantir que todas as alterações sejam aplicadas corretamente.**
```
php artisan config:cache
```
9. **Gere o autoload para garantir o carregamento das dependências e pacotes PHP:**
```
composer dump-autoload -o
```
10. **Realize as migrações para a base de dados configurada:**
```
php artisan migrate
```
11. **Popular as tabelas do banco de dados com os registros (dados iniciais) use o arquivo de lote .`bat` que contém todas as seeders em ordem que devem ser chamadas, se a ordem for alterada pode dar erro de integridade referencial:**
```
seed_cad_pessoa
```
12. **Execute o servidor de desenvolvimento:**
```
php artisan serve
```
13. **Abra o site no navegador no endereço:**
```
http://127.0.0.1:8000
```
14. **Já existe uma conta administrativa para fazer login no sistema, digite**
```
login: admin@admin.com
senha: 123
```
15. **Para limpar o banco de dados e executar novamente as migrações: Remove todas as tabelas inclusive a de migração e logo após recria todas novamente rodando todas as migrações automaticamente**
```
php artisan migrate:fresh
```
**Refaça o passo 11 para popular novamente o banco de dados para realizar novamente os testes abaixo.**

<p style="font-size:12pt; color:#2563eb; font-weight:bold;">
Como o intuito é comprovar e operacionalizar o backend para realizar o cadastro de pessoas de vários tipos, assim criar rotas, controladores e views demandariam muitos esforços que no momento não é o foco da proposta lançada iremos testar o sistema usando o terminal do Laravel através do Tinker para realizar o nosso CRUD.
</p>

## Utilizando o Tinker para interagir com a base de dados utilizado recursos do Models e Eloquent ORM:

Para maiores informações sobre o `Eloquent ORM` e `Tinker` consulte:

- [Eloquent documentação Laravel](https://laravel.com/docs/11.x/eloquent)
- [Eloquent documentação alternativa em pt-BR](https://laravel-docs-pt-br.readthedocs.io/en/latest/eloquent/)
- [Tinker documentação Laravel](https://laravel.com/docs/11.x/artisan#tinker)

<p style="font-size:12pt; color:#889330; text-align: center;">
Para entra no terminal do Tinker utilize o seguinte comando:
</p>

```
php artisan tinker
```
#### Teste as operações abaixo no terminal do Laravel: copie e cole no Tinker.

### Cadastrando pessoas no sistema (C - CREATE)

$$
TESTANDO-ELOQUENT-ORM-NO-TINKER
$$

1. Cria uma pessoa e armazena o retorno na variável `$pessoa`
```
$pessoa = App\Models\Pessoa::create(['status_id' => 1, 'nome' => "Emerson Ferreira", 'logradouro' => "Rua A", 'numero' => "20",'bairro' => "São Caetano", 'cidade' => "Salvador", 'uf' => "BA", 'complemento' => "casa da frente",'cep' => "40.222-030",'ibge' => "312050",'telefone' => "(71) 3958-5817",'celular' => "(71) 985252-1010", 'email' => "emerson.ferreira@test.net.br"])
```

2. Cria uma pessoa física e associa a uma pessoa e armazena o retorno na variável `$pessoa_fisica`
```
$pessoa_fisica = App\Models\PessoaFisica::create(['pessoa_id'=> $pessoa->id, 'cpf'=> "001.296.778-76", 'rg'=> "99.338.775", 'data_nascimento'=> DateTime::createFromFormat('d/m/Y', "30/10/1977")->format('Y-m-d')])
```

3. Cria um funcionário e associa a uma pessoa física e armazena o retorno na variável `$funcionario`
```
$funcionario = App\Models\Funcionario::create(['pessoa_fisica_id' => $pessoa_fisica->id, 'data_admissao' => DateTime::createFromFormat('d/m/Y', "28/02/2000")->format('Y-m-d')])
```

4. Cria um vendedor e associa a uma funcionário e armazena o retorno na variável `$vendedor`
```
$vendedor = App\Models\Vendedor::create(['funcionario_id' => $funcionario->id, 'comissao' => 15.5])
```

5. Verificação: Retorna a última pessoa que foi criada
```
$p1 = App\Models\Pessoa::with('status')->with('tipos_pessoas')->with('pessoa_fisica.funcionario.vendedor')->latest()->first();
```

### Realizando consultas aos dados já cadastrados (R - READ)

$$
TESTANDO-ELOQUENT-ORM-NO-TINKER
$$

1. Nessa consulta existem vários relacionamentos da tabela pessoas com (`with`):tabela `status`, `tipos_pessoas`, e com as tabelas em cascata: `pessoa_fisica`, `funcionario` e `medico`.
   Retorna a pessoa de `id = 3` com todos seus dados, o status, os tipos de pessoas que está associado, os dados de pessoa física, de funcionário e de médico.
```
App\Models\Pessoa::with('status')->with('tipos_pessoas')->with('pessoa_fisica.funcionario.medico')->find(3);
```

2. Retorna a pessoa de `id = 3` semelhante ao que foi feito anteriormente só que neste caso `filtra ($query->select('tipo');)` os campos do relacionamento com a tabela `tipos_pessoas` só para retornar dessa tabela o campo `tipo` e atribui esse registro a variável `$pessoa`.
```
$pessoa = App\Models\Pessoa::with('status')->with(['tipos_pessoas'=> function($query){$query->select('tipo');}])->with('pessoa_fisica.funcionario.medico')->find(3);
```

3. Retorna um `Collections` com todos os tipos associados a pessoa localizada anteriormente.
```
$pessoa->tipos_pessoas
```

4. Retorna apenas o nome do tipo associado a pessoa selecionada de acordo com a chave informada 0 ou 1
```
$pessoa->tipos_pessoas[0]['tipo']
$pessoa->tipos_pessoas[1]['tipo']
```

### Atualizando dados de pessoas no sistema (U - UPDATE)

$$
TESTANDO-ELOQUENT-ORM-NO-TINKER
$$

1. Localizamos o registro de `id=17` criado anteriormente e armazenamos na variável `$p1`:
```
$p1 = App\Models\Pessoa::with('status')->with('tipos_pessoas')->with('pessoa_fisica.funcionario.vendedor')->find(17);
```

2. Confira o nome da pessoa selecionada, deve aparecer `"Emerson Ferreira"`
```
$p1->nome
```

3. Faça a alteração no nome desta pessoa
```
$p1->nome = "Emerson Pereira Santana"
```
ou (update via bind: no caso abaixo já atualiza direto e não precisa `saveAll()`)
```
$p1->update(['nome' => "Emerson Pereira Santana"])
```

4. Verifique a comissão associada ao tipo vendedor associada a esta pessoa, deve aparecer `"15.50"`
```
$p1->pessoa_fisica->funcionario->vendedor->comissao
```

5. Faça alteração no valor da comissão dessa pessoa
```
$p1->pessoa_fisica->funcionario->vendedor->comissao = 25.5
```
ou (update via bind: no caso abaixo já atualiza direto e não precisa `saveAll()`)
```
$p1->pessoa_fisica->funcionario->vendedor->update(['comissao' => 25.5])
```

6. Salve as alterações realizadas, que estão em memória, no banco de dados. Dentro do `saveAll()` é usado o método `push()` do `Model` e outras lógicas de: transação, validação e tratamento de exceções em uma classe de serviços.
```
$p1->saveAll()
```

7. Repete a consulta do `passo 1` para verificar que as alterações foram persistidas e confira também nas tabelas do banco de dados
```
$p1 = App\Models\Pessoa::with('status')->with('tipos_pessoas')->with('pessoa_fisica.funcionario.vendedor')->find(17);
```

8. Cria uma pessoa do tipo `ClientePessoaFisica` e associa a pessoa que está selecionada: `$p1`
```
$cliente_pessoa_fisica = App\Models\ClientePessoaFisica::create(['pessoa_fisica_id' => $p1->pessoa_fisica->id, 'desconto' => 3.33])
```

9. Realiza uma nova consulta para constar o novo relacionamento de `$p1` com o tipo `ClientePessoaFísica` e confira também no banco de dados
```
$p1 = App\Models\Pessoa::with('status')->with('tipos_pessoas')->with('pessoa_fisica.cliente_pessoa_fisica')->with('pessoa_fisica.funcionario.vendedor')->find(17);
```


### Deletando uma pessoa do sistema (D - DELETE)

$$
TESTANDO-ELOQUENT-ORM-NO-TINKER
$$

1. Carrega para a memória a pessoa que se deseja e filtra-se a relação de tipos as quais a pessoa está vinculada nesse caso: `ClientePessoaFisica`, `Funcionario` e `Vendedor`
```
$p1 = App\Models\Pessoa::with(['tipos_pessoas' => fn ($q) => $q->select('tipo')])->find(17);
```

2. Carrega a relação da pessoa selecionada apenas com `ClientePessoaFisica`
```
$p1->load('pessoa_fisica.cliente_pessoa_fisica')
```

7. Exibe apenas os detalhes de `ClientePessoaFisica`
```
$p1->pessoa_fisica->cliente_pessoa_fisica
```

3. Apaga apenas `ClientePessoaFisica` e recebe `true` se tudo ocorre bem
```
$p1->pessoa_fisica->cliente_pessoa_fisica->delete()
```

4. Carrega novamente dados do banco e exibe pessoa sem o vínculo com `ClientePessoaFisica` <span style="color:#889330;"> (gatilho em desenvolvimento para excluir a relação da tabela `pessos_tipos`) </span> 
```
$p1 = App\Models\Pessoa::with('status')->with('tipos_pessoas')->with('pessoa_fisica.funcionario.vendedor')->find(17);
```

5. Apaga a pessoa selecionada e todas as suas relações por completo, e recebe `true` se tudo ocorre bem
```
$p1->delete()
```

6. Refaz a consulta inicial para tentar recuperar os dados a pessoa de `id=17` e recebe como resposta `null` pois já não consta mais no banco de dados
```
$p1 = App\Models\Pessoa::with('status')->with('tipos_pessoas')->with('pessoa_fisica.funcionario.vendedor')->find(17);
```

&nbsp;
&nbsp;
&nbsp;

> "Ninguém ignora tudo. Ninguém sabe tudo. Todos nós sabemos alguma coisa. Todos nós ignoramos alguma coisa. Por isso aprendemos sempre."
*Paulo Freire*

