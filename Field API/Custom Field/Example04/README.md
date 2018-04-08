To get current time in date field

```
$element['startdate'] = [
  '#type' => 'datetime',
  '#title' => 'Start Date',
  '#default_value' => DrupalDateTime::createFromTimestamp(time()),
  '#size' => $this->getSetting('startdate_size'),
  '#placeholder' => $this->getSetting('placeholder')['startdate'],
  '#maxlength' => $this->getFieldSetting('max_length'),
];
```

To format date time filed

```
$element['startdate'] = [
'#type' => 'datetime',
'#title' => 'Start Date',
//'#date_date_element' => 'text',
'#date_date_element' => 'none',
'#date_date_format' => 'Y/m/d',
'#date_time_element' => 'text',
'#date_time_format' => 'H:i:s A',
'#default_value' => DrupalDateTime::createFromTimestamp(time()),
'#size' => $this->getSetting('startdate_size'),
'#placeholder' => $this->getSetting('placeholder')['startdate'],
'#maxlength' => $this->getFieldSetting('max_length'),
];
```

Time table

```
a - "am" or "pm"
A - "AM" or "PM"
d - day of the month, 2 digits with leading zeros; i.e. "01" to "31"
D - day of the week, textual, 3 letters; i.e. "Fri"
F - month, textual, long; i.e. "January"
h - hour, 12-hour format; i.e. "01" to "12"
H - hour, 24-hour format; i.e. "00" to "23"
g - hour, 12-hour format without leading zeros; i.e. "1" to "12"
G - hour, 24-hour format without leading zeros; i.e. "0" to "23"
i - minutes; i.e. "00" to "59"
j - day of the month without leading zeros; i.e. "1" to "31"
l (lowercase 'L') - day of the week, textual, long; i.e. "Friday"
L - boolean for whether it is a leap year; i.e. "0" or "1"
m - month; i.e. "01" to "12"
n - month without leading zeros; i.e. "1" to "12"
M - month, textual, 3 letters; i.e. "Jan"
s - seconds; i.e. "00" to "59"
S - English ordinal suffix, textual, 2 characters; i.e. "th", "nd"
t - number of days in the given month; i.e. "28" to "31"
U - seconds since the epoch
w - day of the week, numeric, i.e. "0" (Sunday) to "6" (Saturday)
Y - year, 4 digits; i.e. "1999"
y - year, 2 digits; i.e. "99"
z - day of the year; i.e. "0" to "365"
Z - timezone offset in seconds (i.e. "-43200" to "43200")
```

Note: Can not make work of datetime filed

Check: https://www.drupal.org/node/1455576