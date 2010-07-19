Shopify Textmate Bundle
=======================

Available Commands:
-------------------

* Download Theme: Will download the entire theme from Shopify. Useful when you just getting started. This can take a while, so be patient. 
* Update Current File From Shopify : Will replace the contents of the file you are working on with the file from the live site. 
* Send Selected Files to Shopify : 
* Send Asset to Shopify : Will save the document you are working on, and upload to shopify. Used for text documents.

Usage
-----
You need to set up the following Project Variables. (Or I suppose you could just set up some Global Vars in the Textmate Prefs. But Project Variables make more sense to me in this case) 

    * SHOPIFY_API_KEY
    * SHOPIFY_PASSWORD
    * SHOPIFY_STORE

You can get the info for how to get the values for the below vars here: http://wiki.shopify.com/Private_apps

See 

    * Project Dependent Variables: http://manual.macromates.com/en/environment_variables#project_dependent_variables 
    
and 
    
    * Static Variables: http://manual.macromates.com/en/environment_variables#static_variables

for more info on setting up the Variables for TM

* the theme folder should be your Project Root. ie: drag the theme folder onto textmate.

* Requires json_decode / json_encode functions. 
Built into php 5.2 + greater. Could prolly be converted to use XML, but I happen to find xml a pita.


Tips
----

If you aren't using version control, you should. This bundle will not protect you from yourself.

It's basically just a poor-man's FTP for shopify.

Mitchell Amihod
July 19, 2010.
