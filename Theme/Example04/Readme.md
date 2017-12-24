1. If you want to change the look of your page, you can create your own "page.html.twig". "page.html.twig" is the main display of your home page. by default it is located at "core\modules\system\templates\page.html.twig".

To enable Twig Debug = true follow this if there is no services.yml here; then make a copy of the default.services.yml file and rename it to services.yml and under that file make twig.config debug: true.

Now lets create our own "page.html.twig" instead of using default. Create /theme/custom/myth/templates/page.html.twig

"page.html.twig" contains 3 main elements.

	1. Html markup of your theme.
	2. Region definitions.
	3. Variables for other content items.

```html
<div id="page">
    <section id="headline">
    	...
    </section>

    <header>
    	...
    </header>
    
    <section id="main">
    	  <div id="content">
              ...
          </div>
              
          <aside id="sidebar">
               ...
          </aside>
    </section>
    
    <footer>
    	...
    </footer>
</div>
```

We have created basic html regions for the page, including headline, header, main, and footer regions. Notice that if you add these regions, you must define them in your info.yml file first.

2. Now we will add some twig code to our "page.html.twig". Basic of twig is 

```twig
	{{ These }} are for printing content
	{% These %} are for executing statements
	{# These #} are for comments
	{{ variable|filter }} for filter variable

	{{ dump() }} Print out all variables on the page
	{{ dump(foo) }} Print content of the foo variable
```

And final code of "page.html.twig"

```html
<h1> Hello world </h1>
<div id="page">

  {% if page.headline %}
    <section id="headline">
      {{ page.headline }}
    </section>
  {% endif %}

  {% if page.header %}
      <header>
        {{ page.header }}
      </header>
  {% endif %}
    
    <section id="main">
      <div id="content">
            {{ page.content }}
        </div>
            
      {% if page.sidebar %}
          <aside id="sidebar">
               {{ page.sidebar }}
          </aside>
      {% endif %}
    </section>

    {% if page.footer %}
      <footer>
        {{ page.footer }}
      </footer>
  {% endif %}

</div>
```

The content section is an exception. It does not need a conditional statement because there will always be something in the content region.

Note that after clearing the cache of drupal if your browser does not show the page content with "hello world" then there must be some problem.
