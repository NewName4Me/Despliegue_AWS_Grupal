#!/bin/bash
sudo yum update -y
sudo yum install -y httpd git
sudo mkdir -p /var/www/html
# Clona el repositorio de GitHub
sudo git clone https://github.com/NewName4Me/Chess-Web-For-Class.git /tmp/tu_repositorio
# Mueve solo la carpeta deseada al directorio web
sudo mv /tmp/tu_repositorio/ProyectoFinal2Trimestre/* /var/www/html/
# Limpia eliminando el repositorio clonado
sudo rm -rf /tmp/tu_repositorio
sudo systemctl enable httpd
sudo systemctl start httpd
