Drupal custom block module using drupalconsole cmd

```
~/Sites/uniservice$ drupal gm
~/Sites/uniservice$ drupal gpb
```

When created it will be avaiable in structure->block layout->place Block

Folder structure after creation of that module

```
Uniservice
	-modules
		-custom
			-hello_world
				hello_world.info.yml
				hello_world.module
				- src
					- Plugin
						- Block
							ArticleBlock.php
```