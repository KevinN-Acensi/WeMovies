FROM php:8.0.2-fpm

# Add requirements and optionals packages
RUN apt-get update && apt-get install -y \
    git \
    wget \
    zsh \
    curl \
    sudo \
    vim

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

# Symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | bash && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Add useful alias
RUN echo 'alias sf="php bin/console"' >> ~/.bashrc

# Create a group and user for developer
RUN addgroup --system developer --gid 1000
RUN adduser --system developer --uid 1000 --ingroup developer

# Define the working directory
WORKDIR /var/www