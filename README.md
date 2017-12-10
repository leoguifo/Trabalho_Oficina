micro framework MVC

# Classe View

### Construtor

Parametros 
  view: nome do arquivo de view (em resource/views) sem a extensão(.php).
  variaveis: variaveis a serem passadas para a view, precisa ser em array, ['nome da variavel' => $valor].
  
 Função asset
 
  retorna o diretório a partir da pasta public.
  
 Função route
  
  retorna o caminho para a rota, o parametro é o nome da rota(definido no arquivo config/Routes.php).
  
# Classe Database

  Na pasta app/Model deve conter os models para as tabelas, precisa ter um protected $tabela com o nome da tabela
  
  ### Usando Models
  
    Para usar um model, basta chamalo usando use App\Model\nomeDoModel;
    
    instancie sempre que for usar.
    
    Funções da Database será listado em outro momento.
    
### Configurando Database

  o arquivo para configuração do banco de dados está em config/Database.php
  
  esse arquivo contém um array com as chaves, db_host para o hhost, db_nome para o nome do banco, db_usuario para o login, db_senha para a senha e db_driver para o driver a ser usado.
  
# ROTAS

  As rotas estão em config/Routes.php.
  
  Para adicionar rotas, adicione um novo array sendo que:
    
    O primeiro valor se refere ao caminho da rota, o segundo ao método HTTP, o terceiro ao controler seguido de @ e a função, e o quarto o nome para chamar nas views e controllers
    
   ##### Função redirect
   
    Chame esta função passando o nome da rota para redirecionar a mesma.
    
  Definindo variaveis na rota
  
    Se quiser por variavel na rota, coloque o nome entre { }, assim ela será passada como parametro para a função do controller.
    
  
