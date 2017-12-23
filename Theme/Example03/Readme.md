1. Adding base theme in your "myth.info.yml". 

```yml
name: Myth
description: A starter theme for Drupal 8.
type: theme
base theme: classy
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

In Drupal 8, there are 2 default base themes.

	#Stable - minimal markup and very few classes (default base theme in D8)
	#Classy - provide default markup with sensible classes for styling

Stable
------
```html
<div>
<div>Cars</div>
<div>
  <div>BMW</div>
  <div>Mercedes</div>
  <div>Honda</div>
</div>
</div>
```

Classy
------
```html
<div class="region field-name-field-cars field--type-string field--label-above">
<div class="field__label">Cars</div>
<div class='field__items'>
  <div class="field__item">BMW</div>
  <div class="field__item">Mercedes</div>
  <div class="field__item">Honda</div>
</div>
</div>
```

Drupal folder structure

```yml
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
