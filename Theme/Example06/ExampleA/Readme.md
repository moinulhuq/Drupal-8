To use "logo.png" or something else, you need to add custom settings definition in your theme. To do this, add the following lines to  theme/myth/config/install/myth.settings.yml file in your theme folder. After doing this, you must reinstall your theme if already installed.

myth.settings.yml
-----------------
```yml
logo:
  path: 'themes/custom/myth/logo.png'
  use_default: false
```
