1. If you want to add "Hello World" to the existing twig template then copy "page.html.twig" from core/modules/system/templates/page.html.twig and paste it to your myth/templates folder then start editing that page and write "<h1>Hello World</h1>".

page.html.twig
---------------
<h1>Hello World</h1>

clear cache and call home page of your site, then it will display.

2. In Drupal 8, Page content always (any text or images) come from twig template. 

```
page.html.twig reposible for => all page
page--front.html.twig reposible for => front page
page--node--2.html.twig reposible for => specific node (here node 2)
```

If you want to change any content of those pages (frontpage or node2page) then create those twig templates (page--front.html.twig or page--node--2.html.twig) under templates folder of yourtheme folder (uniservice/themes/custom/myth/templates/).

myth.info.yml
-------------
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
  header: Header
  menubar: Menubar
  sidebar: Sidebar
  content: Content
  footer: Footer
screenshot: screenshot.png
```

Here "page.html.twig" template, you can construct your page by using html markup.

page.html.twig
---------------
<div class="page">
   <header class="header" role="header">
      <div class="container">
         {{ page.header }}
      </div>
   </header>
   <nav id="menubar" class="navbar navbar-default" role="navigation">
      <div class="container">
         {{ page.menubar }}
      </div>
   </nav>
   <section id="main" class="main" role="main">
      <div class="container">
         <div class="row">
            <aside class="sidebar col-sm-3">
               {{ page.sidebar }}
            </aside>
            <div class="content col-sm-9">
               {{ page.content }}
            </div>
         </div>
      </div>
   </section>
   <footer class="footer" role="footer">
      <div class="container">
         {{ page.footer }}
      </div>
   </footer>
</div>

As you can see, In Drupal 8, every "page" has multiple regions and every region contains one or more blocks.

page
-----
Header region
  -Banner block

Menubar region
  -Menu block

content section
  -Sidebar region
  -Contents region
  -images block

footer region
  -footer block

If you want to display any content in your page you need to create a block and place it to the specific region only then it will display.

let's say, you want to show "copyright@example.com" this text then create one block from Structure->Block layout (it could be custom block as well) and then place it to the footer block.

Then Output of "page.html.twig" is 

page.html
-------------
```html
<footer class="footer" role="footer">
   <div class="container">
      <div class="region region-footer">
            <h2>copyright@www.com</h2>
            </div>
         </div>
      </div>
   </div>
</footer>
```

Now you can do some styling of that "footer region" or blocks belongs to that "footer region".

sass
-----
```css
.footer{
  h2{
    border: 1px solid;
    text-align: center;
    font-size: 14px;
    color: grey;
  }
}
```

You can do as much chain as you want

sass
-----
```css
.footer{
  h2{
    color: grey;
    a{
      text-decoration: none;
    }
  }
}
```

3. If you want to convert "html" template to drupal 8 "twig" template then start converting the "index.html" to "page.html.twig"

index.html
----------
```html
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title of the document</title>
</head>
<body>
  <div class="header">
  </div>
  <div class="menubar">
  </div>
  <div class="content">
  </div>
  <div class="sidebar">
  </div>
  <div class="footer">
  </div>
</body>
</html>
```

From "index.html" => "page.html.twig".

page.html.twig
---------------
```html
<div class="page">
  <div class="header">
    {{page.header}}
  </div>
  <div class="menubar">
    {{page.menubar}}
  </div>
  <div class="content">
    {{page.content}}
  </div>
  <div class="sidebar">
    {{page.sidebar}}
  </div>
  <div class="footer">
    {{page.footer}}
  </div>
</div>
```

As you can see converting "html" to "twig" is so easy just add the regions (region declared in myth.info.yml) with {{ }} and it will automatically be the drupal 8 template.