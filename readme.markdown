Shopify Textmate Bundle (now compatible with e-texteditor)
==========================================================

Nov. 10, 2013 - Notification Center support:
--------------

* This fork include support for Notification Center in OS X Mavericks. To use it, you must have terminal-notifier installed. You must also be using the latest preview edition of TextMate.


Available Commands:
-------------------

* **Download Theme** : Will download the entire theme from Shopify. Useful when you just getting started to download the whole Theme, or if you are working with other, to refresh your copy.
* **Send Asset to Shopify** ( ⌘U ) : Will save the document you are working on, and upload to shopify. Used for text assets.
* **Send Selected Files to Shopify** ( ⌘-SHIFT-U ) : Will upload any files you have selected in the Project Panel to Shopify. This is what you want to use to upload a bunch of files at once.
* **Get Rendered CSS file from .css.liquid** : Will download the rendered .css file from the .css.liquid file. See [this](http://forums.shopify.com/categories/2/posts/40499) forum post for more info about the issue.
* **Update Current File From Shopify** : Will replace the contents of the file you are working on with the file from Shopify.
* **Update Selected Files from Shopify** : Will fetch the files you have selected in the Project Window from Shopify.
* **Remove Selected Assets From Shopify** : Will remove the selected assets from Shopify server. Certain .liquid files cannot be removed (index, theme, page, product, blog, collection)   
I didn't assign a shortcut to avoid accidents, but CTRL-SHIFT-R is a good one if you need one.
* **Pages: Download All** Downloads all pages to a folder called Pages. 
* **Pages: Upload Current** Upload the current Page.html you are working on ( ⌘U )
* **Pages: Preview Current** Previews the current page. Requires you have the Liquid gem installed.  
(Experimental! :D) Not quite perfect yet, but it's working. Have a go at it. 
* **Open Store Admin In Default Browser (Textmate only)** Exactly what it says. 
* **Wiki: Liquid (TM Only)**  Opens the Shopify Liquid wiki page.
* **Switch Shop (TM Only)** Switch which shop project is pointing at. You need to be using the new config file for this functionality.
* **New Config (TM Only)** Creates the new config file for you in your project directory. 
* **Edit Config (TM Only)** Edit your config file .

(For windows usage, please see the [windows readme](https://github.com/meeech/shopify.tmbundle/blob/windows-compat/readme-windows.markdown))

Usage
-----

For great instructions, with screenshots and everything, see the excellent guide on the [Shopify wiki](http://wiki.shopify.com/Shopify_Textmate_Bundle).

The bundle now supports multiple shops, so you could have your config info for your Dev shop, and your Live shop, and easily switch between them. 

* Create a new folder in your OS where you'd like to store your project assets and other files
  * Create a new file inside of the folder. 
  * Open that project folder in TextMate and open the new file, then go to Bundles > Shopify > Config > New Config. This will create the file `.shopify-tmbundle` in your folder. (You might not see it, since files beginning with `.` are hidden depending on your settings.)
  * Fill it in with your shop details.   
  * You can edit your configs at any time using Shopify > Config > Edit Config
* The Theme folder should be your Project Root. ie: drag your Theme folder onto Textmate.
* Here's a short video of how to use [Download Theme](http://www.vimeo.com/13472939)
* Requires json\_decode / json\_encode functions. Built into php 5.2 + greater.

Tips
----

* Get the [Liquid bundle](http://github.com/andrew/liquid-tmbundle). It helps. 
* Really. Don't forget to set the required variables.
* If you aren't using version control, you should. This bundle will not protect you from yourself.
* Assign HotKeys to the various commands to suit your needs. To avoid unpleasant accidents, I only assigned a shortcut to the Send commands, since the other commands will generally need to be used less frequently. 

Installation
------------

The simplest way is to install it using the [GetBundles bundle](http://solutions.treypiepmeier.com/2009/02/25/installing-getbundles-on-a-fresh-copy-of-textmate/). This will allow you to always have the latest version. Its just a super useful bundle. I can't recommend it enough. 

For a much better, visual guide, see the [Shopify wiki](http://wiki.shopify.com/Shopify_Textmate_Bundle).

Otherwise you can just download and install the bundle in a few easy steps.

* Download the zip file: [http://github.com/meeech/shopify.tmbundle/zipball/master](http://github.com/meeech/shopify.tmbundle/zipball/master)
* Unzip it
* Rename the folder it creates for you as **shopify.tmbundle**
* It should then appear as a regular TextMate Bundle. Double click, and TextMate should just install it. 

If you don't, or can't, use GetBundles, you can always follow me ([@meeech](http://www.twitter.com/meeech)) on twitter - i'll announce updates there as well. 

About
-----

At work [(Plank Design)](http://www.plankdesign.com) we recently had a client who will be using Shopify. The workflow of Shopify for building themes (Copy/Paste into a textarea, upload assets via a form) was less this ideal, especially since Vision is currently not supporting any of the latest features. This solves that problem. Props to Shopify for having their API support GETting and PUTting of assets.

Feedback welcome.

Mitchell Amihod  
July 19, 2010.
