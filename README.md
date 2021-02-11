Symfony Template Application v5.2
=================================

The "Symfony Template" is a template based on the reference application created to show how
to develop applications following the [Symfony Best Practices][1].

Requirements
------------

* PHP 7.4.9 or higher;
* PDO-SQLite PHP extension enabled;
* and the [usual Symfony application requirements][2]
* ~~node v14.15.4~~
* ~~yarn v1.22.5~~

Incuded
-------

* [Symfony v5.2.1][4]
* [jQuery v3.5.1][7]
* [Bootstrap v4.6.0][5]
* Bootstrap icons 1.3.0
* [Theme bootswatch Flatly][6]
* Font-awesome 5.12.1

ToDo: Installation
------------------

[Download Symfony][4] to install the `symfony` binary on your computer and run
this command:

```bash
$ symfony new --demo my_project
```

Alternatively, you can use Composer:

```bash
$ composer create-project symfony/symfony-demo my_project
```

ToDo: Usage
-----------

There's no need to configure anything to run the application. If you have
[installed Symfony][4] binary, run this command:

```bash
$ cd my_project/
$ symfony serve
```

Then access the application in your browser at the given URL (<https://localhost:8000> by default).

If you don't have the Symfony binary installed, run `php -S localhost:8000 -t public/`
to use the built-in PHP web server or [configure a web server][3] like Nginx or
Apache to run the application.

ToDo: Tests
-----------

Execute this command to run tests:

```bash
$ cd my_project/
$ ./bin/phpunit
```

[1]: https://symfony.com/doc/current/best_practices.html
[2]: https://symfony.com/doc/current/reference/requirements.html
[3]: https://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html
[4]: https://symfony.com/download
[5]: https://getbootstrap.com
[6]: https://bootswatch.com/flatly/
[7]: https://jquery.com/
