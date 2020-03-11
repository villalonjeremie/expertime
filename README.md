# expertime test


Several constraints :   

• Import users from this URL: GET https://reqres.in/api/users 

A sample call: GET https://reqres.in/api/users?page=1

 

Answer :

• Suggest an import of a single customer by id (ex: https://reqres.in/api/users/2) or a global import (ex: https://reqres.in/api/users) from an interface Magento import in Back Office (no constraints on the display of the interface, the premium functional)

• If the user has a profile picture, display it in the "my account" section. There will be an "avatar" field to be created at the client entity level.  

 

Once you have completed the test, please send me the module files so I can revert to our Lead dev. Please be reminded that the aim of this test is for us to understand how well you utilize the magento features.

First command to have before using the module
```
bin/magento setup:di:compile
bin/magento setup:upgrade
```

Go to System>Import Customer by URL and use the feature putting the url. 

Avatar Attribute is avalaibled in front end creating customer/updating customer/back office customer section
