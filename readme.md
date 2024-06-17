#  jap.burkhalter.dev 

A project to help people to learn Japanese. I made it when I was trying to learn Japanese, but I spent more time making the tool than using it :)

## Getting Started

### Prerequisites

- PHP 7.4 (PHP ⩾8.0 is not compatible yet)
- MySQL

### Installing

- Clone the repository and copy config files:

```bash
git clone https://github.com/BurkhalterY/jap.git
cd jap/application/config/
cp config.php.sample config.php
cp database.php.sample database.php
```

- Edit `database.php` with your MySQL credentials.
- Manually create the database and import `database/jap-with-data.sql` or `database/jap-struct-only.sql` into it, depending on whether you want the live data or not.

You can use an all-in-one solution such as XAMPP, UwAmp to run this project. Alternatively, you can use the following command in the repository root: `php7.4 -S 0.0.0.0:8000`.

## Built With

- [CodeIgniter 3](https://codeigniter.com/userguide3/) - the PHP framework

jap.burkhalter.dev is also partially based on one of my previous projects: [Normalux](https://github.com/BurkhalterY/normalux.ch), especially for the drawing system.

## Contributing

This project is not actively maintained, but feel free to contribute. I'll read all issues and PR.
