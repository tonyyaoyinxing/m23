git update-index --assume-unchanged ./../.idea
git update-index --assume-unchanged ./../public_html/app/etc/config.php

cd ./../public_html
php /www/admin/local.m2.com_80/wwwroot/m23/bin/magento maintenance:enable
php /www/admin/local.m2.com_80/wwwroot/m23/bin/magento setup:upgrade
php /www/admin/local.m2.com_80/wwwroot/m23/bin/magento setup:di:compile
php /www/admin/local.m2.com_80/wwwroot/m23/bin/magento setup:static-content:deploy -f
php /www/admin/local.m2.com_80/wwwroot/m23/bin/magento setup:static-content:deploy zh_Hans_CN -f
php /www/admin/local.m2.com_80/wwwroot/m23/bin/magento maintenance:disable
#chmod -R 755 .
#find . -type f -exec chmod 644 {} \;
#find . -type d -exec chmod 755 {} \;
chmod -R 777 pub/media
chmod -R 777 pub/static
chmod -R 777 pub/opt
chmod -R 777 generated
chmod -R 777 var
