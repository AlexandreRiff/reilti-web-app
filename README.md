<p align="center">
<img src="./public/img/logotipo.png" width="300px">
</p>

## 📖 Descrição

Este projeto é um Repositório Educacional Interoperável, desenvolvido em Laravel, que utiliza o padrão LTI (Learning Tools Interoperability). Ele permite a inserção de diversos recursos didáticos, como pacotes HTML (zip contendo arquivos HTML, CSS e JS), PDFs e áudios. Além disso, os recursos podem ser compartilhados com ambientes virtuais de aprendizagem através do serviço externo LTIAAS, utilizando a interoperabilidade proporcionada pelo LTI.

## ⚙️ Funcionalidades

-   Inserção de recursos didáticos (HTML, PDF, Áudio).
-   Compartilhamento via LTI.

## 🛠️ Tecnologias Utilizadas

-   Laravel 10
-   PostgreSQL
-   Redis
-   HTML5
-   CSS3
-   JavaScript
-   Bootstrap5
-   Docker

## 💻 Pré-requisitos

-   Docker e Docker Compose Instalado.

## 🚀 Instalação

1. Clone o repositório para a sua máquina local:

```bash
git clone https://github.com/AlexandreRiff/reilti-web-app.git
```

2. Navegue até o diretório do projeto:

```bash
cd reilti-web-app
```

3. Execute o docker:

```bash
cd docker/dev && docker-compose up -d --build
```

## 🧩 LTI

Para habilitar o serviço de compartilhamento LTI siga esses passos:

1. Crie uma conta em [LTIAAS](https://docs.ltiaas.com).
2. Configure a conta utilizando este [guia](https://docs.ltiaas.com/guides/introduction).
3. Configure as seguintes variáveis de ambiente no arquivo `.env`.

```bash
LTIAAS_URL=
LTIAAS_KEY=
```

## ☕️ Uso

-   Acesse a aplicação no seu navegador:

```
http://localhost/login
```

Utilize as seguintes credenciais:

-   Usuário: `admin@reilti.com`
-   Senha: `admin`
