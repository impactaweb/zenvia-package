### Instalação

Basta adicionar o pacote no require do arquivo *composer.json*:
```
"require": {
  "php": "^7.2",
  "fideloper/proxy": "^4.0",
  "laravel/framework": "^6.2",
  "laravel/tinker": "^2.0",
  "impactaweb/zenvia": "^0.0.1"
},
```
E depois indicar o repositório, também no arquivo *composer.json*:
```
"repositories": [
  {
    "type": "vcs",
    "url": "https://github.com/impactaweb/zenvia"
  }
]
```

### Configuração

Adicione as variáveis abaixo no arquivo *.env*:
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
return $zenvia->sendSms($numero, $texto;
```
