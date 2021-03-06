# xampp-settings( XAMPP Version 7.4.27 )
```
PHP 7.4.27 (cli) (built: Dec 14 2021 19:52:13) ( ZTS Visual C++ 2017 x64 )
Copyright (c) The PHP Group
Zend Engine v3.4.0, Copyright (c) Zend Technologies
```
## Apache httpd.conf
ドキュメントルートを設定\
![image](https://user-images.githubusercontent.com/1501327/157797077-d2723772-6072-4c7e-8083-6cdf8b7ac2ca.png)


[Visual Studio 2017 の Microsoft Visual C++ 再頒布可能パッケージ](https://go.microsoft.com/fwlink/?LinkId=746572)\
[Redistributable packages for Visual Studio 2015, 2017, 2019, and 2022](https://docs.microsoft.com/en-us/cpp/windows/latest-supported-vc-redist?view=msvc-170)

## C:\java16 と C:\XAMPP を前提

### TOMCAT 用 レジストリ設定
```
Windows Registry Editor Version 5.00

[HKEY_LOCAL_MACHINE\SOFTWARE\JavaSoft]

[HKEY_LOCAL_MACHINE\SOFTWARE\JavaSoft\Java Development Kit]
"JavaHome"="C:\\java16"
```
### web.xml
![image](https://user-images.githubusercontent.com/1501327/157796064-d2a50ec5-c80b-48d0-ad50-7ac687d74c30.png)
```xml
        <init-param>
            <param-name>listings</param-name>
            <param-value>true</param-value>
        </init-param>
```
![image](https://user-images.githubusercontent.com/1501327/157795752-fae270c3-edf0-4f1f-b8b8-21fac2f69e37.png)
```xml
        <init-param>
            <param-name>trimSpaces</param-name>
            <param-value>true</param-value>
        </init-param>
        <init-param>
            <param-name>compilerSourceVM</param-name>
            <param-value>1.8</param-value>
        </init-param>
        <init-param>
            <param-name>compilerTargetVM</param-name>
            <param-value>1.8</param-value>
        </init-param>
```

<br>

### 起動は管理者権限で
![image](https://user-images.githubusercontent.com/1501327/156975831-d5a147ec-ca9c-46bc-886c-6e7e5a7da6c6.png)

![image](https://user-images.githubusercontent.com/1501327/156976102-e448f722-6956-44ff-97eb-534c89a0920f.png)

![image](https://user-images.githubusercontent.com/1501327/158916638-988a77d6-55cc-426c-a67f-4698a4ae7236.png)

![image](https://user-images.githubusercontent.com/1501327/158917061-61a6c569-8d19-44da-aef0-70c93c344fc6.png)


![image](https://user-images.githubusercontent.com/1501327/156976052-a376f120-86b2-4f73-94c9-b3ae049a372b.png)

## MySQL の設定
### C:\xampp\mysql\bin\my.ini

![image](https://user-images.githubusercontent.com/1501327/156976420-7b22dfbb-96e9-4d79-ad49-b5e7dba1845e.png)
22/04/20
```
## UTF 8 Settings
#init-connect=\'SET NAMES utf8\'
#collation_server=utf8_unicode_ci
character_set_server=utf8
#skip-character-set-client-handshake
#character_sets-dir="C:/xampp/mysql/share/charsets"
sql_mode=NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION
log_bin_trust_function_creators=1

character-set-server=utf8mb4
collation-server=utf8mb4_general_ci
[mysqldump]
max_allowed_packet=16M
```

## Connector/ODBC
[ODBC ドライバ](https://downloads.mysql.com/archives/c-odbc/)

![image](https://user-images.githubusercontent.com/1501327/157796595-18e0f77c-4bc7-46fc-8893-cde12db08873.png)

## ログイン
```
mysql -h localhost -u root --password=
```

## データベース作成
```sql
create database lightbox;
exit
```

## インポート
```
mysql -h localhost -u root -D lightbox --password= < lightbox.sql
```
