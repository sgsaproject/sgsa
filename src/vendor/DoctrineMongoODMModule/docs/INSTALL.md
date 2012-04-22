# Installing the Doctrine MongoDB module for Zend Framework 2 
The simplest way to install is to clone the repository into your /vendor directory add the 
DoctrineMongoODMModule key to your modules array before your Application module key.

  1. cd my/project/folder
  2. git clone git://github.com/doctrine/DoctrineMongoODMModule.git vendor/DoctrineMongoODMModule --recursive
  3. open my/project/folder/configs/application.config.php and add 'DoctrineMongoODMModule' to your 'modules' parameter.
  4. drop config/module.doctrine_mongodb.config.php.dist into your application config/autoload folder
     and make the appropriate changes.
     
## Usage
Access the document manager using the following di alias: 

    $em = $this->getLocator()->get('mongo_dm');