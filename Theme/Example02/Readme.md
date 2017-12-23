1. Now define the region of your template which is generally known as block. Add region section to "myth.info.yml"

```yml
name: Myth
description: A starter theme for Drupal 8.
type: theme
core: 8.x
libraries:
  - myth/global-css
  - myth/global-js
stylesheets-remove:
  - core/assets/vendor/normalize-css/normalize.css
  - core/modules/system/css/system.module.css
  - core/modules/system/css/system.theme.css
  - core/modules/views/css/views.module.css
regions:
  headline: headline
  header: header
  content: content
  sidebar: sidebar
  footer: Footer
```

Drupal folder structure

```html
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
```
