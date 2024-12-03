# 🌐 Página Dinámica con PHP

Este es el código fuente de mi página web dinámica que utiliza PHP. Dado que GitHub Pages solo soporta contenido estático, esta página no puede ser visitada directamente desde GitHub Pages. Sin embargo, puedes ejecutarla localmente siguiendo las instrucciones a continuación.

## 🌟 Tecnologías Utilizadas

<img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white">
<img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white">
<img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white">
<img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black">

## 📋 Descripción

Este proyecto es una página web dinámica que utiliza PHP para generar contenido en tiempo real. Incluye funcionalidades interactivas y se puede ejecutar localmente en un servidor PHP.

## ✨ Características

- Generación dinámica de contenido utilizando PHP.
- Interfaz amigable y fácil de usar.
- Funcionalidades interactivas implementadas con JavaScript.

## 📁 Estructura del Proyecto

- `index.php`: Página principal de la aplicación.
- `styles.css`: Archivo de estilos CSS.
- `script.js`: Archivo JavaScript con la lógica interactiva.
- `images/`: Carpeta que contiene imágenes utilizadas en la página.

## 🚀 Instalación

### Ejecutar Localmente

Para ejecutar este proyecto localmente, sigue estos pasos:

1. Clona este repositorio:
    ```sh
    git clone https://github.com/tu-usuario/pagina-php.git
    ```
2. Navega al directorio del proyecto:
    ```sh
    cd pagina-php
    ```
3. Asegúrate de tener un servidor PHP instalado. Puedes usar `php -S` para iniciar un servidor local:
    ```sh
    php -S localhost:8000
    ```
4. Abre tu navegador y navega a `http://localhost:8000/index.php`.

### Publicar en GitHub Pages

Dado que GitHub Pages no soporta PHP directamente, puedes usar GitHub Actions para generar archivos HTML estáticos a partir de tu contenido PHP. Aquí tienes un ejemplo de configuración para GitHub Actions:

Crea un archivo `.github/workflows/main.yml` en tu repositorio con el siguiente contenido:

```yaml
name: Build and Deploy

on:
  push:
    branches:
      - main

jobs:
  build:
    runs-on: ubuntu-latest

    steps:
      - uses: actions/checkout@v2

      - name: Set up PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '7.4'

      - name: Install dependencies
        run: composer install

      - name: Generate HTML files
        run: php -S localhost:8000

      - name: Deploy to GitHub Pages
        uses: peaceiris/actions-gh-pages@v3
        with:
          github_token: ${{ secrets.GITHUB_TOKEN }}
          publish_dir: ./public
