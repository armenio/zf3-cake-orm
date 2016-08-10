# zf3-cake-orm
The Cake ORM Module for Zend Framework 3

## How to install


1. Install via composer. Don't know how? [Look here](http://getcomposer.org/doc/00-intro.md#introduction)

2. `cd my/project/directory`

3. Edit composer.json :

```json
{
	"require": {
		"armenio/zf3-cake-orm": "1.*"
	}
}
```

4. Edit config/application.config.php :

```php
'modules' => array(
	 'Application',
	 'Cake', //<==============================
)
```

5. Change your Model namespace in cd my/project/directory/vendor/armenio/zf3-cake-orm/config/module.config.php

```php
	'Cake' => array(
		'Configure' => array(
			'App' => array(
				'namespace' => 'Application' //<======= put your App/Module namespace HERE!
			),
		),
	),
```

6. Create your models
	
	6.1. Go to my/project/directory/your/app/namespace

	6.2. Create a directory Model/Table/

	6.3. Go to my/project/directory/your/app/namespace/Model/Table/

	6.4. Create the File MyTable.php


```php
<?php
namespace Application\Model\Table;

use Cake\ORM\Table as CakeORMTable;

class MyTable extends CakeORMTable
{
	// ...
}
```

See more here: http://book.cakephp.org/3.0/en/orm.html

## How to use

```php
<?php
use Cake\ORM\TableRegistry;
$table = TableRegistry::get('MyTable');
$all = $table->find('all');

foreach ($all as $row) {
	// ...
}
```