

useradd bbb
passwd bbb
gpasswd -a bbb wheel
su - bbb
mkdir .ssh
chmod 700 .ssh
vi .ssh/authorized_keys

chmod 600 .ssh/authorized_keys
sudo sed -i 's/^PasswordAuthentication yes/PasswordAuthentication no/' /etc/ssh/sshd_config
sudo sed -i 's/^ChallengeResponseAuthentication yes/ChallengeResponseAuthentication no/' /etc/ssh/sshd_config
sudo sed -i 's/^#\?PermitRootLogin\s\+yes/PermitRootLogin no/' /etc/ssh/sshd_config
sudo systemctl restart sshd

sudo yum -y update

sudo yum install -y httpd
sudo systemctl enable httpd
sudo systemctl start httpd
sudo sed -i '/<Directory "\/var\/www\/html">/,/<\/Directory>/ { s/AllowOverride None/AllowOverride All/i }' /etc/httpd/conf/httpd.conf
sudo systemctl restart httpd

sudo yum install -y firewalld
sudo systemctl start firewalld
sudo systemctl enable firewalld
sudo firewall-cmd --permanent --add-port=80/tcp
sudo firewall-cmd --permanent --add-port=443/tcp
sudo firewall-cmd --reload

# Open SELinux config
sudo vi /etc/selinux/config

# And change SELINUX=enforcing to SELINUX=disabled, then save the file, and shutdown
sudo shutdown -r now

sudo yum -y install epel-release
sudo rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm

sudo yum -y install php72w php72w-gd php72w-mbstring php72w-mysqlnd php72w-xml php72w-common php72w-tidy php72w-cli php72w-intl
sudo yum install -y php72w php72w-{common,mysql,gd,mbstring,xml,tidy,pear,intl,devel,opcache}
sudo sed -i "s/;date\.timezone.*/date\.timezone = America/New_York/g" /etc/php.ini
sudo sed -i "s/memory_limit.*/memory_limit = 256M/g" /etc/php.ini
sudo sed -i "s/max_execution_time.*/max_execution_time = 60/g" /etc/php.ini

sudo yum install -y mariadb-server
sudo systemctl enable mariadb
sudo systemctl start mariadb
sudo mysql_secure_installation

sudo php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer

sudo yum install -y git
