ProcessWire Dynamic Selects
================================

Copyright 2016 by Francis Otieno (Kongondo)

PLEASE DO NOT DISTRIBUTE
========================

This is a commercial ProcessWire module that is authorized only for 
use in accordance with the attached licence (see the file 'module-name-licence-type.txt')
where 'licence-type' equates to the licence you purchased, for instance 'single'.

Support is provided only to the purchaser.

If you did not purchase this copy of Dynamic Selects, you should obtain a copy from
the (author's) ProcessWire Marketplace at: http://processwireshop.pw/ 


ABOUT DYNAMIC SELECTS
==========================

Dynamic Selects enables the creation of dynamically related/dependent ajax-driven chained dropdowns
for display and storage (storage only if used as a Field) of data. Selects can be built and displayed
in the frontend (ProcessDynamicSelects and MarkupDynamicSelects) or used in the backend
(FieldtypeDynamicSelects)

The values that can be displayed are: page field values (please see list below), user property values,
templates (label|name) and field names (label|name). In the case of field values and user properties,
the following core ProcessWire Fieldtypes are supported:

FieldtypeDatetime, FieldtypeEmail, FieldtypeFile, FieldtypeFloat, FieldtypeImage, FieldtypeInteger,
FieldtypeOptions, FieldtypePage, FieldtypePageTitle, FieldtypeText and FieldtypeURL.

In the case of images or files, the names of the files will be displayed as options for selection in
the dropdowns.

Setting up Dynamic Selects is very easy. With minimal effort, site developers can set up simple or
complex chained selects for use by site editors. When used in the frontend, Dynamic Selects allows
for convenient filtering of data, enabling your site visitors to quickly find information or express
a choice. 

By making a selection in a trigger drowndown, via ajax, values are fetched and dynamically populate
options in the dependent select. In turn, making a selection in the now populated select triggers the
same action further down in a dependent select. The module only uses ID references to selected
options in the selects meaning the most current/up-to-date data will always be displayed in the
selects. 

There is no limit to the number of selects/dropdowns that can be defined per each Dynamic Selects. 

For frontend use only, server-side and client-side (local) caching of a Dynamic Selects can be enabled,
speeding up fetching of results and limiting the number of ajax-requests to your server.

Dynamic Selects is a useful Markup and Fieldtype module in any developer's toolbox offering multiple
use cases.


REQUIREMENTS
============

ProcessWire 2.5 or newer.
jQuery (for frontend only).


DOCUMENTATION
=============

Full documentation and demos available at http://dynamicselects.kongondo.com


HOW TO INSTALL DYNAMIC SELECTS
==============================


########################################### WARNING ###########################################

On install the module will create a template (dynamic-selects), a field (ds_settings) and
a permission (dynamic-selects). You need to ensure that you have no such named components
in your system BEFORE you attempt to install this module.


On uninstall of the module, these components will be automatically deleted as well as any
Dynamic Selects created for the frontend.

########################################### END WARNING ###########################################

The ZIP file that the module comes in can be uploaded directly to
your admin in Modules > New > Upload. If your modules file system is
not writable, you can also install it this way: 

1.	Copy the Dynamic Selects files into the directory:
	/site/modules/DynamicSelects/. Please note that the module
	consists of 4 modules:
		i)		ProcessDynamicSelects
		ii)		MarkupDynamicSelects
		iii)	FieldtypeDynamicSelects
		iv)		InputfieldDynamicSelects

	The first two enable use in the frontend and the latter two for the backend.

2.	In your ProcessWire admin, go to Modules and click "Refresh".

3.	Click "Install" for the ProcessDynamicSelects module.
	This will automatically install the other 3 modules. 

Following installation, you will need to set up the module depending on whether you
want to use it in the front or backend or even both. Instructions follow below:


SECURITY
========

Dynamic Selects fetch (using ajax) and display data in the dropdowns based on the ID of the item
selected in the trigger dropdown. For frontend use, this is a potential security issue. However, the
visibility of the ID itself does not present any security issue. ProcessWire itself references page
IDs when returning assets such as files and images. In addition, the IDs of various core ProcessWire
pages (admin, setup, trash pages, etc) are public knowledge. Of concern to us is the potential
manipulation of markup (e.g. using a browser's dev tools) generated by Dynamic Selects by a
malicious user in an attempt to trick the module to fetch and return data (pages, users, fields or
templates) that that user is not authorised to view. To guard against such manipulation, Dynamic
Selects ships with a number of security features. These are noted below as well as best-practices
which you need to follow when setting up the module for frontend use.

In-built Security Features
--------------------------

1. Dynamic Selects does not fetch nor display ProcessWire admin pages
2. Dynamic Selects skips, hence does not display, data from password, roles and permissions fields
3. Dynamic Selects does not display data about system templates and superusers
4. Dynamic selects does not fetch nor display unpublished or hidden pages
5. Dynamic selects does not fetch nor display data of pages
whose templates have access controls in place in cases where the current user has no access
6. By default, each Dynamic Selects in the frontend is only displayed to Logged-in users.
Alternatively, these can be set up to be viewable only by users with the permission dynamic-selects-
front-view'
7. For frontend use, Dynamic Selects always caches the valid server-side data to be
displayed in the first/initial select/column

Best-practices: Using Dynamic Selects in the Frontend
-----------------------------------------------------

1. If possible, only allow users with the permission 'dynamic-selects-front-view' to view frontend
Dynamic Selects or at least Logged-in users. Please refer to the the settings section on how to set
this up.

2. Make extensive use of include/exclude templates/pages/fields to filter-out/in data that will be
displayed in your Dynamic Selects. For instance, you can use a range of IDs to block out pages that
should not be shown in the selects. Remember though, as noted above, unpublished, hidden and
template-access-controlled pages data will never be returned (whether as a trigger or a dependent
column) in Dynamic Selects

3. If 'Users' has been selected as the data in the first/initial dropdown, it is highly recommended
that you add ProcessWire's Title field to the 'user' template and use that to input your users'
titles. Dynamic Selects will first attempt to use a title and if one is not found, will use the
user's name as data for that dropdown. Since users names are used for logging in, this is not
desirable. Ideally, you should avoid setting up a 'Users' Dynamic Selects in the frontend

4. Give any fields that will be listed in Dynamic Selects columns/dropdowns of relationship Field or
User: Property labels. Otherwise, the field names will be displayed instead.

5. Always test your Dynamic Selects before deploying them. This is also applicable to backend
Dynamic Selects. Testing ensures that the Dynamic Selects return the data you expect them to.

6. Related to the above, when testing frontend Dynamic Selects, make use of the debugging feature to
easily see the returned results and their IDs.

Please note that the above (security features and best-practices) apply to the columns/selects in a
Dynamic Selects whether it is a trigger or dependent select or both. This means that the module
cannot be tricked into accepting an invalid trigger in order to return its data (so-called trigger
select manipulation). It also means that for valid triggers, it will also only return data that the
user is allowed to view (so-called dependent select fidelity).

In summary, given the above in-built security features, when it comes to pages and templates,
frontend users (including guests) will only ever see pages that they are authorised to view. Since
unpublished, hidden and template-access-controlled pages are never returned, any other pages you may
not want them to see will be because of convenience and not security. Beyond these though, you have
the powerful include/exclude settings at your disposal. For selects that return fields, it is
imperative that you limit the fields to be displayed (if necessary) by using include/exclude fields
settings.


HOW TO SET UP DYNAMIC SELECTS
=============================

Frontend
--------

For frontend use, Dynamic Selects are built and defined in ProcessDynamicSelects.
Click on DynamicSelects in your Admin menu to start building selects. The process
is pretty straightforward. You add 1 or more selects then define settings of each.

To bulk edit your selects (e.g. lock them for editing, publish, trash or delete them),
click on their respective selection checkboxes. Then in the Actions pane below them,
choose an action and click Apply.

To edit a single Dynamic Selects, click on its title. That will open it in its own 
editing screen. The process of defining settings for Dynamic Selects is the same whether
used in the front- or backend. See below for the common instructions.


Backend
-------

For backend use and selects' data storage, you need to build and define settings in 
FieldtypeDynamicSelects. 

1. Create a new field in ProcessWire of type 'DynamicSelects'.
2. Add the field to a template of your choice.
3. Head over to your field's 'Details Tab'. There are a number of settings here that need
to be completed:


Dynamic Selects Settings: Front- and Backend
-------------------------------------------

Dynamic Selects settings for front- and backend use are very similar. There are a few exceptions
though that only apply to frontend use, for instance, caching. These are explained below.


@NOTE:

i. IN ADDITION TO THE NOTES BELOW, IT IS ALSO IMPORTANT THAT YOU READ THE NOTES THAT ACCOMPANY EACH
SETTING, VISIBLE WHEN EDITING THE SETTINGS.

ii. IT IS ALSO STRONGLY RECOMMENDED THAT YOU CONDUCT SOME TEST RUNS ON HOW TO USE THIS MODULE BEFORE
YOU USE IT IN PRODUCTION. FOR FRONTEND USE, THIS IS IMPORTANT FROM A SECURITY POINT OF VIEW. FOR
THE BACKEND, THIS IS IMPORTANT SINCE SETTING UP A DYNAMIC SELECTS FIELD REQUIRES CHANGES TO THE
DATABASE SCHEMA FOR THE FIELD.

iii. In ProcessDynamicSelects the settings are spread over two Tabs: 'Build' and 'Settings'. In
FieldtypeDynamicSelects, these are to be found in the 'Details' tab.

************************

a. First Column Data Source (radios):

Specify the type of data that will populate the first/initial dropdown select. This could be 'Pages',
'Templates' or 'Users'. The first dropdown is very important since it initiates the cascading of
chained-selects.

b. First Column Selector (text):

In this input, specify a valid ProcessWire selector compatible with your choice in the type of data
to be expected in the First Dynamic Select in 'a.' above. Some examples:

- for Pages: template=products, sort=title {this will be fed to a:
$pages->find('template=products, sort=title') query};

- for Templates: name=products-clothes|products-electronics|products-groceries
{this will be fed to a:
$templates->find('name=products-clothes|products-elecronics|products-groceries') query}

- for Users: roles!=38, sort=title, sort=name {will be fed to a:
$users->find('roles!=38, sort=title, sort=name'); query} @note: role with ID 38 = superuser role

c. First Column Custom PHP Code(textarea):

This setting overrides the selector specified in b. Here you can specify valid PHP code to return
data for the first select. The statement must only return a WireArray derived object such as group
of templates and PageArray.

The statement entered here has access to the ProcessWire API variables $page, $pages, $templates and
$users. Since the statement will be evaluated on page load, you need to be very careful about what
the code actually does. Example code:

	- return $page->children("limit=10");

	- return $templates->find("tags=some-tag");

	- return $users->find

	A more complex example (@note: pseudo code!)

	- $myPages = $pages->find('template=some-template, limit=50');
	$pA = new PageArray();
	foreach($myPages as $p) {
	  if($p != 'some condition') continue;
	  else $pA->add($p);
	}

	return $pA;


d. Include/Exclude: Templates, Pages, Fields (textarea):

There are 6 settings here. Before using them, please carefully read the Usage Notes displayed right
above them. The settings can be used in combination with each other except when they are of the same
type. By type we mean 'Templates', 'Pages' or 'Fields'. These settings should be applied to specific
column/dropdown. They should be on separate lines for each dropdown and their first value should be
the name of the dropdown. For instance:
	continent,1,2,5-10,
	country,1,2,3,5-10,12,4,21-36
	Etc...

As shown in the examples above, you can use comma-separated or a range of IDs OR both.

The 6 settings here are:

	- Included Templates: Use this to include	pages that use the specified template IDs in the
	results. 
	- Excluded Templates: Exclude pages that use the specified template IDs. 
	- Included Pages: Include pages with the specified IDs.
	- Excluded Pages: Exclude pages with the following IDs.
	- Included Fields: Include fields with the specified IDs.
	- Excluded Fields: Exclude fields with the following IDs.

For more in-depth information on expected results when these filters are used in combination, please
see the Usage Notes.

e. Hide Empty Selects (checkbox):

Please see Please see 'j.' below

f. Dynamic Selects Column Settings:

In this HTML table, you define the names of your dropdown selects as well as their labels. In the
case of FieldtypeDynamicSelects, each name will correspond to a column name in your field's
database table. In that case, each database column will be used to store the selected data for the
corresponding dropdown. 

In this HTML table you also define the triggers, relationships and data sources for and between your
dynamic dropdowns. 

Each step required in this specific setting is described in more detail below.

Unless otherwise specified, the settings below only apply to frontend use and are found only in 
ProcessDynamicSelects for use in MarkupDynamicSelects. These settings are found in the 'Settings' Tab

g. Dynamic Selects Title(text):

Use this to modify the Title (and subsequently the name) of the Dynamic Selects you are editing.

h. Published (checkbox)::

Check/uncheck to publish/unpublish the Dynamic Selects. Unpublished Dynamic Selects are not visible
in the frontend.

i. Locked (checkbox):

Check/uncheck to lock/unlock the Dynamic Selects. Locked Dynamic Selects cannot be edited or deleted.

j. Hide Empty Selects (checkbox):

This also applies to FieldtypeDynamicSelects. Please see 'e.' above

Check to hide all empty selects whose trigger select has no selected value until a selection is made.

k. Which users can view this select in the frontend? (radios):

Choose what type of users can view this Dynamic Selects in the frontend. There are 3 options here:
Logged in users (the default), Users with the permission 'dynamic-selects-front-view' or All users.

l. What to do when user attempts to view a select and has no access? (radios):

Choose from the 5 options what action to take if a user without access attempts to view a
Dynamic Select that is access-controlled. Options are: 'Output nothing', '404', 'Redirect'
'Show login page', or 'Showing a custom message'.

m. Cache ajax responses (checkbox):

Check this to enable caching of returned selects' results. Caches will be created both server-side
and client-side (locally). This enables faster rendering of results and less server-load due to
reduced ajax requests.

n. Cache time (text):

If Cache is enabled in 'm.' above, this input must be filled with time in seconds you want the cache
to live for before it is renewed.


HOW TO SET UP YOUR DYNAMIC SELECTS COLUMNS/DROPDOWNS
===================================================

@note: The term column is used interchangeably with the terms 'selects' and 'dropdowns'. As noted
above, for FieldtypeDynamicSelects, each dropdown has a corresponding and exactly named column in
the database table for your Dynamic Selects field.

@note: Where reference is made to a database table, it is named 'database table'. For markup, that 
will be 'HTML table'.


Use the link 'Add column' to add new rows to the settings HTML table.


The column settings HTML table has 7 columns as described below. Each row in this HTML table
corresponds to ONE dropdown and hence ONE of your database table columns. This is very important to
understand.

The HTML table columns are mainly used to define the dynamism between your dropdowns.


1. Number
This HTML table column has no input. Use it to sort (drag and drop) the order of your rows 
(database table columns) as you wish. Please note that sorting may invalidate the relationship and
triggers between dropdowns. You will need to edit those settings if you sort your dropdowns.
Otherwise, on save, the field will throw an error for invalid relationships and or triggers
(please see notes below).

2. Name
Enter a valid (database-friendly) name to be used as the name of the database table column that
corresponds to the dropdown being defined. Please note that lowercase _a-z0-9 names are enforced.
When this input is empty, it will be highlighted with a reddish background. Attempts to save the field
settings if this input is empty will throw an error.

3. Label Enter a label that will be used to identify your dropdown when rendered on a page
(InputfieldDynamicSelects) or in the frontend (MarkupDynamicSelects). Most likely, the label will
mirror the dropdowns name. E.g. 'country' for name and  'Country' for label. However, this is not a
requirement.

4. Trigger
Here you enter the name of the column or dropdown (they are one and the same) that will trigger the 
dynamic population of a dependent dropdown. For instance, you might have a dropdown named 'products'
whose selections trigger the population of <option> in a dependent dropdown 'price'. In this case, 
the trigger for 'price' is 'products'. In other words, if a page editor selects a product 'Television'
in one dropdown, the price of the Television will be displayed in the adjacent dependent dropdown. 

Naturally, the first/initial dropdown cannot have a trigger dropdown. This is why we earlier
described how to populate the <option>s of the first dropdown. For this reason, the trigger value of
the first dropdown (i.e. the first row in the HTML table) should always be zero (0). Saving the
field with any other value will enforce a 0 value. It also follows that no other dropdown can have a
trigger with a value of 0. Saving the field in that case will result in an error.

@note: Adding a column (HTML table row) automatically populates the TRIGGER value with the name of
the previous row. In other words, the previous column is auto-specified as the TRIGGER for the new
column.
 
5. Relationship This setting consists of 9 pre-set relationship types selectable in a <select>
list/input. Each relationship describes how a DEPENDENT dropdown is RELATED to its TRIGGER dropdown.
For instance, the selectable <option>s in a DEPENDENT dropdown could be child pages of selectable
<option>s in the TRIGGER dropdown.

@note: Relationships are always described as 'How is the dependent select related to its trigger
select?'

@note: Not all relationships for a given trigger are valid for the relationship of the
dependent dropdowns. More about this below.

The 9 present data relationships types are:

	a. None: This is only valid for the first/initial dropdown similar to the trigger value of a
	first dropdown as explained	above.
	b. Child: The DEPENDENT select data/values are the children of the selected PAGE in the TRIGGER
	select.
	c. Parent: The DEPENDENT select data/value is the parent of the selected PAGE in the TRIGGER
	select.
	d. Page: The DEPENDENT select data/values are the pages that use the selected TEMPLATE in the
	TRIGGER select.
	e. Group: The DEPENDENT select data/values are the pages that have the selected PAGE in the
	TRIGGER select
	in their named PAGEFIELD (similar to 'what pages use the category X?').
	f. Field: The DEPENDENT select data/values are the fields present in the selected PAGE in the
	TRIGGER select.
	g. Value: The DEPENDENT select data/values are the values of the named-field of the selected PAGE
	or selected FIELD
	in the TRIGGER select.
	h. User: Property: The DEPENDENT select data/values are the properties (basically fields) for the
	selected USER in the
	TRIGGER select
	i. User: Value: The DEPENDENT select data/vales are the values of the named-field of the selected
	USER or selected PROPERTY in the TRIGGER select.


Invalid trigger=>dependent relationships:
The field will throw an error if for invalid relationships indicating which columns have an invalid 
relationship. Invalid relationships include:

	- A relationship of 'None' on any of the dropdowns except for the first.
	
	- Any other relationship apart from 'None' for the first dropdown.
	
	- A dropdown with a relationship of either a 'Field' or a 'User: Property' CANNOT be a TRIGGER
	for a DEPENDENT select with a 'Child', 'Parent', 'Page', 'Group', 'Field' or 'User: Property'
	relationship.
	
	- A dropdown with a relationship of either a 'Child', 'Parent', 'Page', 'Group', 'Value', or 
	'User: Value' CANNOT be a TRIGGER for a DEPENDENT dropdown with relationship of 'Page', 
	'User: Property' or 'User: Value'.
	
	- A dropdown with the relationship 'Field' CAN ONLY be a TRIGGER for a DEPENDENT dropdown with
	the relationship 'Value' AND a Data Source 'Varies'.

	- A dropdown with the relationship 'User: Property' CAN ONLY be a TRIGGER for a DEPENDENT
	dropdown with the relationship 'User: Value' AND a Data Source 'User: Varies'.

	 - A select with the relationship 'Value' or 'User: Value' CAN ONLY be a TRIGGER if its Data 
	 Source is a PAGEFIELD

	 - If the first/initial dropdown is of type 'Page' it CANNOT be a TRIGGER for a DEPENDENT
	 dropdown with a relationship of Page', 'User: Property' or 'User: Value'.

	 - A 'Page' relationship in the DEPENDENT dropdown can only be directly TRIGGERED by a
	 first/initial dropdown of type 'Templates'. Similarly, 'Templates' as the data in the first
	 dropdown CAN ONLY TRIGGER a 'Page' relationship.

	 - 'Users' as the data in the first/initial dropdown CAN ONLY be a TRIGGER for a DEPENDENT
	 dropdown with the relationship 'User: Property' or 'User: Value'.


6. Data Source For any given dropdown, its value must come from somewhere. These can be either a
field or the name or label of a template or a user. For the first dropdown, if the data type is
'Pages', the titles of the pages are displayed. If 'Template', the label or name of the templates
are displayed. If 'Users', the title or name of the users are displayed.

The Data Source setting is configured by selecting from the options in the select dropdown in the
HTML table. For the first dropdown, the Data Source must always be 'Initial'.

The rest of the options in these setting is a list of all compatible fields as well as 5 other
pre-set Data Sources. Where a data source is one of these compatible fields, that is referred to as
a named-field. For instance, if the data source was Integer, that would mean the named-field is
'Integer' and that would be the returned value for that dropdown.

The 5 pre-set data sources are:

a. Initial: Only applicable to the first dropdown. In other words, 'Initial' must always be the data
source for the first dropdown.
b. Fields: Field relationships MUST always have the data source 'Fields'.
c. Varies: If a TRIGGER select's relationship is 'Field' the data source of its DEPENDENT select
MUST BE 'Varies'. The is because the returned value 'varies' depending on the field selected in the 
TRIGGER dropdown.
d. User: Properties. This MUST always be the data source for the relationship 'User: Property'.
e. User: varies. Similar to 'Varies' above but for cases where the TRIGGER relationship is
'User: Property'

For pre-sets a, b and d, invalid data sources will not be selectable right within the data sources. 

In addition, Group relationships CAN ONLY have pagefields as their data source. If you select such a
relationship for a dropdown, the selectable options in the data source column will only be pagefields.

All invalid data sources will throw an error with an explanation of what needs to change.

7. Trash can Use this to mark a dropdown (AND HENCE a database table column in the case of
FieldtypeDynamicSelects) for DELETION. For FieldtypeDynamicSelects, a confirmation dialog will pop-up
for such actions. Click on the trash can in the HTML table column header to mark all HTML table rows
(hence database table columns) for deletion. Click on a trash can a second time to deselect any
previous selection. In the case of DynamicSelects for the frontend, selected data in the dropdown
are not stored in the database. Please see notes below on deletion!

Column Database Operations (Backend/FieldtypeDynamicSelects ONLY):

a. Adding dropdowns
Click on the link 'add column'. What this does is to create a column(s) in the field's database table
when the field is saved.

b. Renaming
You can rename your columns at any time. This will also rename the corresponding columns in the
fields table in the database. Please note that renaming a column will mean changing all instances of
the column name in your template files if applicable.

c. Deleting columns will lead to loss of the data that was saved in THAT COLUMN in the
database table of your field across all pages that use the field. Hence, caution should be
exercised. A dialog pops-up to confirm such action. Click on 'Save' to OK the changes OR 'Cancel' to
discard all suggested changes.


Example Dynamic Selects Column Settings. HTML TABLE 1

@note: Here we assume First Dynamic Select Data Source setting is 'Pages'.

	NAME			LABEL			TRIGGER		RELATIONSHIP		DATA SOURCE
1	countries		Countries		0			None				Initial
2	cities			Cities			countries	Child				Title
3	attractions		Attractions		cities		Value				Attractions

In HTML TABLE 1, the settings mean:

a. Editing a page with the above Dynamic Select field, on page load, all the dependent selects are
displayed side by side. In the first/initial dropdown, a list of all 'country' pages matching the
specified selector or the custom PHP CODE (Please see above for selector or custom PHP code setting)
are listed as <option> for that first <select>.

b. On change/selection of an <option> in the first dropdown, an Ajax request is sent requesting the
data for listing all child pages of the page selected in the TRIGGER select 'countries'. Data is
sent back from the server as JSON. This is used to build the <option>s for the dependent select
'cities'. For this select, the data source is Title. It means the Titles of the child pages will be
listed as values. The data source could have been any other compatible field in the child pages, for
instance a datetime, a pagefield, options, etc. Specifying any of those would have those listed in
the dropdown in page edit.

c. If an <option> is selected in 'cities', this fires an Ajax request to the server. Since the
relationship in the DEPENDENT dropdown 'attractions' is 'Value', it means that the server should
return the value of the field 'Attractions' (specified as Data Source) for the requested 'cities'
page. In this case, 'Attractions' is a PAGEFIELD in the requested 'cities' page. Hence, the server
returns the list of pages currently selected in the pagefield 'Attractions'.

Translating the above to a real-world example, the Inputfield of the Dynamic Select could resemble
the below:

** denotes selected value

Countries			Cities			Attractions
---------			---------		-----------
*Kenya*				*Mombasa*		Diani
France				Nairobi			Mamba Village
Australia							*Fort Jesus*
New York


Selecting 'Kenya' would load its child pages. Of these, selecting 'Mombasa' would load the pagefield
the value of the pagefield 'Attractions' in the page 'Mombasa'. In this case, it contains 3 pages,
'Diani', 'Mamba Village' and 'Fort Jesus'.

The above is a very simple example. More complex selects can be achieved by specifying relationships
as 'Value' and data sources as some named-pagefield...hence enabling cascading further into the
pages selected in those pagefields.


DISPLAYING DYNAMIC SELECTS IN THE FRONTEND
==========================================

MarkupDynamicSelects: Display runtime values
--------------------------------------------

*************** STOPPED HAPA: BUT MOST OF BELOW DONE!*******************************

FieldtypeDynamicSelects: Display saved values in the frontend
-------------------------------------------------------------

At runtime, the field (DynamicSelects object) returns a number of properties. The most important for
frontend use would be the values of each column in the table, i.e. the values of the dropdowns.
Examples are shown below.

@note: Below, columnName refers to the name of a column in dynamic select. For instance, following
the example showing in HTML Table 1 and assuming a dynamic select field named 'dynamic' on a given
$page, the following properties would be returned.

$ds = $page->dynamic;

echo $ds->countries;// would output Kenya
echo $ds->cities;// Mombasa
echo $ds->attractions;// Fort Jesus

OR

echo $page->dynamic->countries;// Kenya
echo $page->dynamic->cities;// Mombasa
echo $page->dynamic->attractions;// Fort Jesus


From the above examples, we can see that the properties returned have their values converted from the
raw ID to user-friendly value.

Also note that the '->countries', '->cities' and '->attractions' are subfields of the property
'dynamic'.

Other properties
--------------------

Additional properties returned by the field follow the format 'columnName' + a predefined SUFFIX.
For instance, 'columnNameID' whereby 'ID' would be ID of the saved value, which is what is stored in
the database.

echo $ds->countriesID;// would output 1234 which in our example is the ID of the page 'Kenya' echo
$ds->citiesID;// outputs ID of Mombasa echo $ds->attractionsID;// outputs the ID of the selected
page in the pagefield 'Attractions', i.e. 'Fort Jesus'.

@note: For values from pagefields, the ID of the page in the pagefield is stored. For other fields,
the ID of the field itself is stored, e.g. '45' could be the ID of an integer field if we had a
column $ds->price;

TRIGGER Properties
echo $ds->countriesTriggerID;// outputs 0 since this is the first dropdown
echo $ds->citiesTriggerID;// outputs 1234 => the ID of Kenya
echo $ds->attractionsTriggerID;// outputs the ID of Mombasa

echo $ds->countriesTrigger;// outputs null as this is the first dropdown
echo $ds->citiesTrigger;// outputs Kenya
echo $ds->attractionsTrigger;// outputs Mombasa

RELATIONSHIP Properties
echo $ds->countriesRelationshipID;// outputs 0 since this is the first dropdown
echo $ds->citiesRelationshipID;// outputs 1, denoting a 'Child' relationship
echo $ds->attractionsRelationshipID;// outputs 6, denoting a 'Value' relationship

echo $ds->countriesRelationship;// ouputs 'None' since this is the first dropdown
echo $ds->citiesRelationship;// outputs 'Child'
echo $ds->attractionsRelationship;// outputs 'Value'

DATA SOURCE Properties
echo $ds->countriesSourceID;// outputs 0 since this is the first dropdown
echo $ds->citiesSourceID;// outputs 1, the ID of the field 'title'
echo $ds->attractionsSourceID;// outputs 114, the ID of the pagefield 'Attractions'

echo $ds->countriesSource;// ouputs 'Initial' since this is the first dropdown
echo $ds->citiesSource;// outputs 'title'
echo $ds->attractionsSource;// outputs 'attractions' {a pagefield}


PAGE ID Property
For 'Varies' and 'User: Varies' data sources, we also have a columnNamePageID property, e.g.
This will return the ID of the page from which the value of the saved field ID should be retrieved.
This is really only important for internal use in the InputfieldDynamicSelects.

EXCLUDED FIELDS Property
Only applicable to data source 'Fields' and where excluded fields have been specified.
columnNExcludedFields is the property here.

EXTRA Property $ds->extraData is the property. This is only useful for internal use to match
selected/saved values in the dropdowns in InputfieldDynamicSelects in cases whereby multiple values
could be selected from one field on one page whereby the values lack unique IDs. For instance,
multiple image fields or multiple file fields.


COLUMN NAMES AND LABELS Properties. Mainly important for internal use. These properties return
arrays of all the column names and column labels defined in the given Dynamic Selects field. The
properties are: $ds->columnNames;// would output array('countries', 'cities', 'attractions');
$ds->columnLabels;// would return array('Countries', 'Cities', 'Attractions');


@note: The field has a toString() method that outputs a HTML table of saved values if the field is
directly echo'ed in a template file. E.g.

echo $page->dynamic;// this would output a HTML table supportch as:

Countries		Cities			Attractions
Kenya			Mombasa			Fort Jesus


Searching/Querying DynamicSelects fields
--------------------------------------

Accessing and outputting the contents of the Dynamic Selects field(s) in your template file requires
knowledge of the ProcessWire selector type referred to as 'Sub-selectors' (Please see:
http://processwire.com/api/selectors/#sub-selectors). This is because this field stores IDs of the
pages, templates, users or fields of selected options in the dropdowns rather than the raw values
themselves.

Assuming we have the following Dynamic Select dropdown and similar ones in other pages ...

Product Type		Product		Price
Clothes				Jeans		100

...we would use the following selector to find the products.


$products = $pages->find("dynamic.product=[title=jeans], dynamic.price=[integer>75]");

In this selector, the sub-selector is enclosed in square brackets []; ProcessWire will run that
query first (i.e. evaluate what is between the square brackets first). That query will return an ID
of the page that contains the given value. For instance, [title=jeans] will return the ID of the
page with the title Jeans. [integer>75] will return the ID of the page whose integer field is
greater than 75.

.product and .price are sub-fields in the field dynamic. In other words, the column names in the
database Table. These also correspond to the names of the select dropdowns.

Internally, ProcessWire will convert the query to dynamic.product=1234, dynamic.price=4567

However, we can make the selector even more efficient with a query such as this:

$products = pages->find("dynamic.product!='', dynamic.price=[integer>75, template=products-clothes
$|products-groceries|products-electronics]");

In the case of a pagefield (using our initial countries, cities, attractions example...) $results =
$pages->find("dynamic.cities!='', dynamic.attractions=[title=Fort Jesus, template=attractions]");

The most important thing to remember in these examples is that the [fieldName = value] corresponds
to our data-source=value!


UPGRADES
========

Upgrades are made available via email notification. Hence, please do not delete the original email
sent to you when you purchased this module. It contains a download link valid for 1 year
(corresponding to 1 year of free ugrades and support).

To install an upgrade, you would typically just replace the old files
with the new. However, there may be more to it, depending on the version.
Always follow any instructions provided with the upgrade version.


DYNAMIC SELECTS VIP SUPPORT
================================

Your Dynamic Selects Licence service includes 1-year of VIP support.

VIP support is available via email: kongondo@gmail.com


HAVE QUESTIONS OR NEED HELP?
============================

Send an email to kongondo@gmail.com.


Thanks for using Dynamic Selects!

---

ProcessWire Dynamic Selects
Copyright 2016 by Francis Otieno



