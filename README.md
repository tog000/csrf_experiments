Cross-Site Request Forgery
================

Experiments showing uses and mitigation techniques for Cross-Site Request Forgeries

Link to live payloads: http://tog000.github.io/

#Test 1:


*Prereq:* The `actions.php` file is included in `config.php`

We email a malicious embedded image to the victim

http://tog000.github.io/evil_email.html

mutt -e 'set content_type=text/html' -s 'Photo of you' 'tog000@gmail.com' < evil_email.html

##Mitigation

`actions_2.php` uses POST variables to mitigate the image attack

#Test 2:

*Prereq:* The `actions_2.php` file is included in `config.php`

We email the victim a link to a self-submitting form:

http://tog000.github.io/evil.html (Won't work due to policies! *GOOD*)

http://tog000.github.io/evil2_container.html

##Mitigation
`actions_3.php` checks the HTTP Origin to prevent cross-site requests

#Test 3:


*Prereq:* The `actions_3.php` file is included in `config.php`

This version is not vulnerable to any of the previous attacks

#Test 4:

*Prereq:* The `actions_4.php` file is included in `config.php`

This version makes use of a one-time token on every request
