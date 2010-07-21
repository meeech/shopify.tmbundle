Shopify Textmate Bundle
=======================

Available Commands:
-------------------

* Download Theme: Will download the entire theme from Shopify. Useful when you just getting started to download the whole Theme. 
* Update Current File From Shopify : Will replace the contents of the file you are working on with the file from Shopify.
* Update Selected Files from Shopify : Will fetch the files you have selected in the Project Window from Shopify.
* Send Asset to Shopify ( ⌘U ): Will save the document you are working on, and upload to shopify. Used for text assets.
* Send Selected Files to Shopify : Will upload any files you have selected in the Project Panel to Shopify. This is what you want to use to upload a bunch of files at once.

Usage
-----

You need to set up the following Project Variables. (Or I suppose you could just set up some Global Vars in the Textmate Prefs. But Project Variables make more sense to me in this case) 

    * SHOPIFY_API_KEY
    * SHOPIFY_PASSWORD
    * SHOPIFY_STORE

You can get the info for how to get the values for those variables here: http://wiki.shopify.com/Private_apps

See 

    * Project Dependent Variables: http://manual.macromates.com/en/environment_variables#project_dependent_variables 

and 

    * Static Variables: http://manual.macromates.com/en/environment_variables#static_variables

for more info on setting up the Variables for TextMate

* The Theme folder should be your Project Root. ie: drag your Theme folder onto Textmate.
* Here's a short video of how to use [Download Theme](http://www.vimeo.com/13472939)
* Requires json\_decode / json\_encode functions. Built into php 5.2 + greater.

Tips
----

* Really. Don't forget to set the required variables.
* If you aren't using version control, you should. This bundle will not protect you from yourself.
* Assign HotKeys to the various commands to suit your needs. To avoid unpleasant accidents, I only assigned a shortcut to the Send Asset to Shopify, since the other commands will generally need to be used less frequently. 

About
-----

At work [(Plank Design)](http://www.plankdesign.com) we recently had a client who will be using Shopify. The workflow of Shopify for building themes (Copy/Paste into a textarea, upload assets via a form) was less this ideal, especially since Vision is currently not supporting any of the latest features. This solves that problem. Props to Shopify for having their API support GETting and PUTting of assets.

Feedback welcome.

Mitchell Amihod  
July 19, 2010.
