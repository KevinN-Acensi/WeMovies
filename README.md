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
##Adding the host locally
