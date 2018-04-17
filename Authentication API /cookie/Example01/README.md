In drupal 8, once anyone logged in, it save cookie under the system.

cookie contain

```yml
	Domain: 'localhost'
	Path: '/''
	Name: 'SESSed18174825848d060cf1308a34df9bb6'
	Store ID: '0'
	Value: 'ImBiAFCi1KAHgHyAd-D8DphpMRZrQXIOi7r4267IGbg'
	Expires: '09/05/2018 08:40 PM'
```

to check this download 'chrome cookie manager' to manage cookies.

In this module if you set _auth: [ 'cookie' ] then you can able to see this page as you are logged in already. Otherwise it will show 'access denied' page.