# 🚀 Sistema de Avaliação de Qualidade de Serviços Prestados

Este é um sistema de coleta de feedback de clientes, projetado para ser usado em diversos dispositivos. As avaliações são anônimas e os resultados são visualizados em um painel administrativo para análise gerencial.

O projeto é construído com **Laravel**, **Filament v3** e **PostgreSQL**.

---

## ✨ Funcionalidades

### 🖥️ Questionário (Front-End do Cliente)

* **Formulário Dinâmico:** As perguntas são carregadas do banco de dados com base no setor do dispositivo.
* **Avaliação por Notas:** Uma escala de 0 (Improvável) a 10 (Muito provável).
* **Design Interativo:** A escala de notas usa um degradê de cores (vermelho para verde) para feedback visual.
* **Coleta Anônima:** Nenhuma informação pessoal é solicitada ou armazenada.
* **Feedback Textual:** Um campo opcional para comentários abertos.
* **Redirecionamento Automático:** Após o envio, uma tela de "Obrigado" é exibida e redireciona para o formulário após 5 segundos.

### ⚙️ Painel Administrativo (Retaguarda)

* **Painel Seguro:** Construído com Filament, com autenticação de administrador.
* **Dashboard de Métricas:**
    * Widget com total de avaliações.
    * Widget com média geral de notas.
    * Gráfico de barras com a média de pontuação por setor.
* **Gerenciamento de Setores:** CRUD completo para criar e editar os setores do estabelecimento (ex: "Recepção", "Caixa", "Vendas").
* **Gerenciamento de Dispositivos:** CRUD para cadastrar os tablets (ex: "Tablet Recepção") e associá-los a um setor.
* **Gerenciamento de Perguntas:** CRUD para criar as perguntas e associá-las a um setor específico.
* **Visualização de Respostas:** Uma lista de todas as submissões recebidas, permitindo ver os detalhes de cada avaliação (notas e feedback).

---

## 🛠️ Tecnologias Utilizadas

* **PHP 8.1+**
* **Laravel 10+**
* **Filament v3** (Para o painel administrativo)
* **PostgreSQL** (Banco de dados)
* **Blade** (Para as views do questionário)
* **CSS/JS puros** (Para o front-end, separados em arquivos `public/`)

---

## 🔧 Instalação e Configuração

Siga estes passos para configurar o ambiente de desenvolvimento.

### 1. Pré-requisitos

* PHP 8.1+
* Composer (ex: composer install)
* Servidor PostgreSQL em execução
* A extensão PHP para PostgreSQL (ex: `sudo apt install php8.1-pgsql`)

### 2. Clone o Repositório

```bash
# Clone o projeto
git clone [[https://seu-repositorio.git/sistema-avaliacao.git](https://seu-repositorio.git/sistema-avaliacao.git)](https://github.com/ArielJahn/sistema-avaliacao.git)
cd sistema-avaliacao

# Arquivo .env
acesse o arquivo .env e altere as inforações conforme a instância do seu banco

# Gerar as tabelas e popular o banco com um admin
php artisan migrate:fresh --seed

#Acesse: http://localhost:8000/admin e faça login com o seguinte usuário e senha: admin@admin.com | 123

#Para acessar o questionário de dispositivos é necessário informar o parâmetro via URL: com ID 1 (ex: Tablet da Recepção): http://localhost:8000/?dispositivo_id=1
