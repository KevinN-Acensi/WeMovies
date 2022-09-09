# Project WeMovies [Ansible, Docker, Symfony 5]

We update Ubuntu and install a minimum required as well as ansible

    sudo apt update && sudo apt upgrade
    sudo apt install software-properties-common
    sudo apt-add-repository --yes --update ppa:ansible/ansible
    sudo apt install ansible git

Install ansible galaxy roles in ansible folder

    cd infrastructure/ansible && ansible-galaxy install -r requirements.yml -p ./.roles --force && cd ../..

Now you will run the ansible playbook in ansible folder

    cd infrastructure/ansible && ansible-playbook -i hosts/dev playbook.yml --ask-become-pass && cd ../..

IMPORTANT: If you encounter a problem with a docker connection, you must reconnect to your session to update your user groups and start over

---
##Configure and start project

Start by running the following command:

    cd infrastructure && make create_start && make permissions && make wemovies-init && cd ..

You will then have to go to the web project and launch yarn again to have the compiled stylesheets :
    
    cd web/WeMovies && yarn install && yarn encore dev

You can now access the following url http://wemovies.local:8081

---
##Area for improvement

Unfortunately, I didn't have time to:
- Add redis to cache API returns and avoid too many calls
- Add pagination because the list does not display entirely due to an overload
- Add symfony UX systems to improve perfs, such as reloading part of the pages only
- Create and manage exceptions / error cases
- Improve the unit tests
- Create search bar system


Possible improvements that could be considered for a real project of this kind:
- Optimize film sorting
- Add functional tests and integration tests (with behat and cypress for example)
- Implementation of a CI/CD