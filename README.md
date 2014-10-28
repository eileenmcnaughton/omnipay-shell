omnipay-shell
=============

basic file structure to provide a starting point for an Omnipay Gateway plugin

To create an Omnipay plug from this
1) ensure you have a function omnipay/composer environment.
  - install composer (https://getcomposer.org/doc/01-basic-usage.md) (useful tips at http://moquet.net/blog/5-features-about-composer-php/)
  - add the following to your composer.json file
      "require":
            {
                "omnipay/omnipay": "~2.0",
            },
   - composer update
1) copy & rename changing omnipay-shell to vendor/yourname/omnipay-yourplugin
2) create an appropriate README e.g based on https://github.com/thephpleague/omnipay-mollie/blob/master/README.md
3) update the composer.json file - looking at the //update comments.
4) take a note of your namespace - ie. this line in composer.json
(    "autoload": {
        "psr-4": { "Omnipay\\Shell\\" : "src/" }//UPDATE
     },
)
and ensure the namespace in all files in the src directory have that namespace (e.g replace Omnipay\Shell with your namespace).
In general doing a find and replace in your src directory on the word Shell should work
5) run composer update in your root folder (ie. vendor should be a folder of the folder you are in) using prefer-source ie.
composer update --prefer-source
6)run the unit tests. You should not proceed further until the tests pass. The tests use phpunit which you can google. The command will look something like
php vendor/phpunit/phpunit/phpunit.php  Omnipay/Shell/SystemGatewayTest



