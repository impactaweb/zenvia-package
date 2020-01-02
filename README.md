### Instalação

Adicione o pacote no require do arquivo *composer.json*:
```
"require": {
  "php": "^7.2",
  "fideloper/proxy": "^4.0",
  "laravel/framework": "^6.2",
  "laravel/tinker": "^2.0",
  "impactaweb/zenvia": "^0.0.2"
},
```
E depois indique o repositório, também no arquivo *composer.json*:
```
"repositories": [
  {
    "type": "vcs",
    "url": "https://github.com/impactaweb/zenvia-package"
  }
]
```
Por fim rode um *composer update* para carregar as alterações.

### Configuração

Adicione as seguintes variáveis no arquivo *.env*:
```
ZENVIA_AUTH_TOKEN=
ZENVIA_SENDER_NAME=
```

### Como usar

Crie a instância:
```
use Impactaweb\Zenvia\SMS;

$zenvia = new SMS();
```
E chame o método:
```
return $zenvia->sendSms($numero, $texto);
```
