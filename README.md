Stack Proyectos PHP API RESTFul
===============================

Código de ejemplo para el manejo de API RESTFul

[**PHP**]
------------------
Recomendaciones de Normas de PHP
http://www.php-fig.org/psr/

RESTFul:
------------------
[**Framework Symfony 2.8.x:**]
    * Dependencia: PHP >= 5.4.0
    https://symfony.com/doc/current/index.html
[**Composer:**]
    * https://getcomposer.org/
    Manejador de dependencias, "no un gestor de paquetes".
    Buscar dependencias y librerias: https://packagist.org/
[**Códigos de estado HTTP:**]
    - https://es.wikipedia.org/wiki/Anexo:C%C3%B3digos_de_estado_HTTP
[**Stack Bundles:**]
    * Doctrine ORM/DBAL:
    - http://www.doctrine-project.org/
* FOSRestBundle:
    - http://symfony.com/doc/master/bundles/FOSRestBundle/index.html
    - composer require friendsofsymfony/rest-bundle
    - configurar
* JMSSerializerBundle (Serializador):
    - http://jmsyst.com/bundles/JMSSerializerBundle
    - composer require jms/serializer-bundle
    - configurar
* NelmioApiDocBundle (ApiDoc):
    - http://symfony.com/doc/current/bundles/NelmioApiDocBundle/index.html
    - composer require nelmio/api-doc-bundle
    - configurar

Comandos para inciar:
---------------------
* $ composer create-project symfony/framework-standard-edition ejemplo_rest "2.8.*"
    * configurar ambiente (base de datos, servidor de email, etc...)
* "Instalar dependencias para api-doc"
* $ php app/console doctrine:mapping:convert yml src/AppBundle/Resources/config/doctrine/metadata/orm --from-database --force
* $ php app/console doctrine:mapping:import AppBundle annotation
* $ php app/console doctrine:generate:entities AppBundle

Comandos para instalar el aplicativo:
-------------------------------------
$ composer install