<h1 align="center">Just TV</h1>

<p align="center"><i>A simple, lightweight web client for HLS streams.</i></p>

<p align="center">
   <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white">
   <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white">
  <a href="https://opensource.org/license/mit"><img src="https://img.shields.io/badge/MIT-green?style=for-the-badge"></a>
   <a href="https://github.com/jrwnnnn/template-global"><img src="https://img.shields.io/github/stars/jrwnnnn/template-global?style=for-the-badge"></a>
</p>

## Prerequisites
Ensure you have the following installed:
- [PHP 8.x](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [Node.js & npm](https://nodejs.org/)
- [MySQL](https://www.mysql.com/)

## Quickstart Guide

1. **Clone the repository**
   ```bash
   git clone https://github.com/jrwnnnn/just-tv.git
   cd just-tv
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configuration**
   - Create a `.env` file in the root directory and configure your database settings:
     ```env
     DB_HOST=localhost
     DB_USER=root
     DB_PASS=
     DB_NAME=
     ```

4. **Build Assets**
   ```bash
   npm run build
   ```

5. **Run the Application**
   You can use the built-in PHP server for development:
   ```bash
   php -S localhost:8000
   ```

## License
This project uses the MIT license. For details, please refer to the LICENSE file.

## Acknowledgments

This web app does not host or store content. All video streams are provided by external third-party sources.

<img src="https://forthebadge.com/badges/built-with-love.svg">
