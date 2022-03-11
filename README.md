# xampp-settings( XAMPP Version 7.4.27 )
```
PHP 7.4.27 (cli) (built: Dec 14 2021 19:52:13) ( ZTS Visual C++ 2017 x64 )
Copyright (c) The PHP Group
Zend Engine v3.4.0, Copyright (c) Zend Technologies
```

### C:\java16 と C:\XAMPP を前提

### TOMCAT 用
```
Windows Registry Editor Version 5.00

[HKEY_LOCAL_MACHINE\SOFTWARE\JavaSoft]

[HKEY_LOCAL_MACHINE\SOFTWARE\JavaSoft\Java Development Kit]
"JavaHome"="C:\\java16"
```
#### web.xml
![image](https://user-images.githubusercontent.com/1501327/157795201-2fb4aac5-4ddc-4abd-ab61-ed53985b6961.png)

<br><br>


![image](https://user-images.githubusercontent.com/1501327/156975831-d5a147ec-ca9c-46bc-886c-6e7e5a7da6c6.png)

![image](https://user-images.githubusercontent.com/1501327/156976102-e448f722-6956-44ff-97eb-534c89a0920f.png)

![image](https://user-images.githubusercontent.com/1501327/156976052-a376f120-86b2-4f73-94c9-b3ae049a372b.png)

### C:\xampp\mysql\bin\my.ini

![image](https://user-images.githubusercontent.com/1501327/156976420-7b22dfbb-96e9-4d79-ad49-b5e7dba1845e.png)

## Connector/ODBC
[ODBC ドライバ](https://dev.mysql.com/downloads/connector/odbc/)

![image](https://user-images.githubusercontent.com/1501327/156979523-760edd53-d433-4486-9176-2591276e756e.png)

## データベース作成
```sql
create database lightbox
```

## インポート
```
mysql -h localhost -u root -D lightbox --password= < lightbox.sql
```
