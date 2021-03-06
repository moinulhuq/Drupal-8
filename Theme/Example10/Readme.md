One complete project design using wireframe of front page "wireframe-front".

1. At first define regions of your website in myth.info.yml

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
  main_menu: 'Main menu'
  main_slidshow: 'Slide show'
  company_brief: 'Company Brief'
  upcoming_products: 'Upcoming Products'
  featured: Featured
  company_objective: 'Company Objective'
  footer: Footer
screenshot: screenshot.png
```

2. Then start creating your "page.html.twig" or "page--front.html.twig".

page.html.twig
--------------
```html
<div class="page">

   <header class="header" role="header">
      <div class="container">
         {% if logo %}
            <a id="logo" href="{{ front_page }}" title="{{ 'Home'|t }}" rel="Home">
              <img src="{{ logo }}" alt="{{ 'Home'|t }}"/>
            </a>
         {% endif %}
         {% if site_name %}      
            <div class="site-name">
               <a href="{{ front_page }}" title="{{ 'Home'|t }}" rel="home">{{ site_name }}</a>
            </div>
         {% endif %}
         {% if site_slogan %}      
            <div class="site-slogan">{{ site_slogan }}</div>
         {% endif %}
         
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu-inner">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

         {{ page.header}}
         </div>
      </div>
   </header>

   {% if page.main_menu %}
      <nav id="main_menu" class="navbar navbar-default" role="navigation">
         <div class="container">
            {{ page.main_menu }}
         </div>
      </nav>
   {% endif %}

   {% if page.main_slidshow %}
      <section id="main_slidshow" class="main_slidshow" role="slidshow">
         <div class="container">
            {{ page.main_slidshow }}
         </div>
      </section>
   {% endif %}

   <section id="compbriefnupcmgprod" class="compbriefnupcmgprod" role="compbriefnupcmgprod">
      <div class="container">
         <div class="row">
            <div class="col-sm-9">
               {{ page.company_brief }}
            </div>
            <aside class="col-sm-3">
               {{ page.upcoming_products }}
            </aside>
         </div>
      </div>
   </section>

   <section id="featured" class="featured" role="featured">
      <div class="container">
         {{ page.featured }}
      </div>
   </section>

   <section id="companyobjective" class="companyobjective" role="companyobjective">
      <div class="container">
            {{ page.company_objective }}
      </div>
   </section>

   <footer class="footer" role="footer">
      <div class="container">
         {{ page.footer }}
      </div>
   </footer>

</div>
```

Here
```
  {{ front_page } = front page address "/uniservice/"
  {{ 'Home'|t }} = make home name translateable
  class="navbar-toggle" = for mobile display
```

3. Place your block from structure=>Block layout

4. Do some styling using sass to manage those blocks. (go to developer tools find those block id or class for styling).

