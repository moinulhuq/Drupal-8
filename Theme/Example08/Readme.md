Drupal 8 theme development using Bootstrap, sass, gulp, browsersync and font-awesome.

1. Presume that you have "nodejs" installed in your machine. to check 

terminal
--------
```
> node -v
> v8.4.0
```

2. Then goto to the folder where you want to install all these (Bootstrap, sass, gulp, browsersync and font-awesome). Here you need to init node package manager which will create "package.json". This json file will contain all the package information for you like package name and version. 

terminal
--------
```
> npm init --y
```

package.json
------------
```json
{
  "name": "myth",
  "version": "1.0.0",
  "description": "",
  "main": "index.js",
  "scripts": {
    "test": "echo \"Error: no test specified\" && exit 1"
  },
  "keywords": [],
  "author": "",
  "license": "ISC"
}
```

3. At frist we will install "Bootstrap". To do this goto "Bootstrap" website then documentation and then download section of that page. We will download all this package using "npm".

terminal
--------
```
> npm install bootstrap@4.0.0-beta.3 --save
> npm i jquery popper.js
```

"jquery" and "popper.js" has dependency over bootstrap for that reason we download that component too.

4. After that we will install "font-awesome".

terminal
--------
```
> npm install font-awesome --save
```

5. Rigth after that we will install sass, browsersync and gulp at a time.

terminal
--------
```
> npm install browser-sync gulp sass --save
```

After isntalling all of the package, the "package.json" will look llike 

package.json
-------------
```json
{
  "name": "myth",
  "version": "1.0.0",
  "description": "",
  "main": "index.js",
  "scripts": {
    "test": "echo \"Error: no test specified\" && exit 1"
  },
  "keywords": [],
  "author": "",
  "license": "ISC",
  "dependencies": {
    "bootstrap": "^4.0.0-beta.3",
    "browser-sync": "^2.23.2",
    "font-awesome": "^4.7.0",
    "gulp": "^3.9.1",
    "jquery": "^3.2.1",
    "popper.js": "^1.12.9",
    "sass": "^1.0.0-beta.4"
  }
}
```
