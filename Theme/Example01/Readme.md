1. Create "custom" folder under drupal "themes" folder.

2. Create another folder under "custom" folder and name it "myth". Here "myth" will be your theme name.

3. Now create create one file name "myth.info.yml" and give detail like below

myth.info.yml
-------------
<code>
name: Myth description: A starter theme for Drupal 8. type: theme core: 8.x </code>
Now if you refresh your appearance tab from admin panel it should show your theme.


4. Now you can notice that there could be some unnecessary css include with your website. To remove this rewirte the "myth.info.yml" file.

myth.info.yml
-------------

name: Myth
description: A starter theme for Drupal 8.
type: theme
core: 8.x
stylesheets-remove:
  - core/assets/vendor/normalize-css/normalize.css
  - core/modules/system/css/system.module.css
  - core/modules/system/css/system.theme.css
  - core/modules/views/css/views.module.css


5. Now add your css and js using "myth.libraries.yml"

myth.libraries.yml
------------------

global-css:
  css:
    theme:
      css/style.css: {}

global-js:
  js:
    js/script.js: {}
  dependencies:
    - core/jquery
    - core/drupal.ajax
    - core/drupal
    - core/drupalSettings
    - core/jquery.once

i.e "css" folder has "style.css" and "js" folder has "script.js" and has dependencies various library.

style.css
---------

body{
	color: red;	
}

script.js
---------

alert("Hi from myth");


6. Now add your libraries reference to "myth.info.yml".

myth.info.yml
-------------

name: Myth
description: A starter theme for Drupal 8.
type: theme
core: 8.x
libraries:
  - atlas/global-css
  - atlas/global-js
stylesheets-remove:
  - core/assets/vendor/normalize-css/normalize.css
  - core/modules/system/css/system.module.css
  - core/modules/system/css/system.theme.css


Drupal folder structure

Drupal
	-core
	-modules
	-profiles
	-sites
	-vendor
	-themes
		-custom
			-myth
				myth.info.yml
				myth.libraries.yml
				-css
					style.css
				-js
					script.js
