# php-blog

If you want to install the projetct locally, be sure to have PHP 7.4 and MYSQL running on an apache server.

Download the files and place in htdocs/blog/, on your local server.

Run composer with these dependencies : 

{
    "require": {
        "twig/twig": "^3.0",
        "ext-pdo": "*"
    },

    "require-dev": {
        "roave/security-advisories": "dev-master"
    },

    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}

Run the sql script on your database, provided in the openclassroom folder, and you're good to go.

Enjoy !

