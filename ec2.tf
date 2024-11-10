# Use data source to retrieve an Amazon Linux 2 AMI
data "aws_ami" "amazon-ami" {
  most_recent = true
  owners      = ["amazon"]

  filter {
    name   = "owner-alias"
    values = ["amazon"]
  }

  filter {
    name   = "name"
    values = ["amzn2-ami-hvm*"]
  }
}


# launch ec2 instance and install your website
resource "aws_instance" "ec2_instance" {
  ami                    = data.aws_ami.amazon-ami.id
  subnet_id              = aws_subnet.public_subnet_erik.id
  instance_type          = var.instance_type
  key_name               = "miPrimeraClave"
  vpc_security_group_ids = [aws_security_group.webserver_security_group.id]
  user_data              = file("command.sh")

  tags = {
    Name = "web-instance"
  }
}
