#!/bin/bash
sudo yum update -y
sudo yum install -y httpd httpd-tools mod_ssl
sudo amazon-linux-extras enable php8.2
sudo yum clean metadata
sudo yum install git php php-php-common php-pear -y
sudo mkdir -p /var/www/html
# Clona el repositorio de GitHub
sudo git clone https://github.com/NewName4Me/Despliegue_AWS_Grupal.git /tmp/tu_repositorio
# Mueve solo la carpeta deseada al directorio web
sudo mv /tmp/tu_repositorio/web/* /var/www/html/
# Limpia eliminando el repositorio clonado
sudo rm -rf /tmp/tu_repositorio
#corrigiendo permisos por fis
sudo chown -R apache:apache /var/www/html
sudo chmod -R 755 /var/www/html
sudo systemctl enable httpd
sudo systemctl start httpd