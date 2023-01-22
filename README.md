# PHP MVC Blog

This is a simple blog built using the Model-View-Controller (MVC) architecture and PHP. It utilizes Composer for dependency management, Twig for templating, and a custom router for handling routes.

Thank you for checking out this project. If you have any questions or feedback, please don't hesitate to reach out.

![Blog](./Screenshot.PNG "Single Post")

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

- PHP >= 7.4
- Composer
- Database

### Installation

Clone the repository

```bash
git clone https://github.com/0xsuid/php-mvc-blog.git
```

Navigate to the project directory and run the following command to install dependencies:

```bash
composer install
```

Create a copy of the .env.example file and rename it to .env. Update the file with your database credentials.

Run the following command to create required database tables:

```bash
mysql -u username -p database_name < db.sql
```

Start the development server by running the following command:

```bash
php -S localhost:8000 -t public
```

Open your browser and navigate to http://localhost:8000

### Built With

- PHP - The programming language used
- Composer - Dependency management
- Twig - Templating engine

## Roadmap

- [ ] Integrate doctrine
- [ ] Integrate Dependency Injection Containers - PSR11
- [ ] Add PHP Unit test
