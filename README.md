# zf3-cake-orm
Cake ORM Module for Zend Framework

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
	 'Cake', // <==============================
)
```

5. Change your Model namespace in cd my/project/directory/vendor/armenio/zf3-cake-orm/config/module.config.php

```php
	'Cake' => array(
		'Configure' => array(
			'App' => array(
				'namespace' => 'Application' // <======= put your App/Module namespace HERE!
			),
		),
	),
```

6. Create your models
	
	6.1. Go to my/project/directory/your/app/namespace

	6.2. Create directory Model/Table/

	6.3. Go to my/project/directory/your/app/namespace/Model/Table/

	6.4. Create the File MyTable.php


```php
<?php
namespace Application\Model\Table;

use Armenio\Cake\ORM\Table;

class MyTable extends Table
{
	// ...
}
```

See more here: http://book.cakephp.org/3.0/en/orm.html

## How to use

```php
<?php
use Armenio\Cake\ORM\TableManager;

$tableManager = new TableManager();

$table = $tableManager->get('MyTable');

$items = $table->find('all')->all();

foreach ($items as $row) {
	var_dump($row);
}
```
