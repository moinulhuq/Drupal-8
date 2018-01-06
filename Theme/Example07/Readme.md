To define your site theme screenshot 

  Either you can mention it in the "myth.info.yml" file like "screenshot: screenshot.png" 
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
  screenshot: screenshot.png
  ```

  Or just put "screenshot.png" or "screenshot.svg" into your theme folder
  ```html
    -theme
      -myth
        screenshot.png
  ```