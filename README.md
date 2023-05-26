# Installationsanleitung
Führen Sie im root Verzeichnis **des Projektes** folgendes aus:
```
docker compose up
```
Öffnen Sie den 'php' container im Terminal und führen Sie folgendes aus:
```
composer install
```
```
php bin/console make:migration
```
```
php bin/console doctrine:migrations:migrate
```
Führen Sie innerhalb von "/app/" folgendes aus:
```
npm install
```
```
npm run build
```
Das Programm wurde mit der npm version 16.18.1 entwickelt und mit der neusten Version **grob** getestet<br>
Nun sollte sich unter [localhost:8080](http://localhost:8080) ein schönes Login-Formular öffnen<br>
Wenn Sie nun [localhost:8080/init](http://localhost:8080/init) aufrufen, wird eine erste Rolle, ein erstes Mitglied und ein erster App-Benutzer angelegt.<br>
Danach können Sie sich mit den folgenden Daten anmelden:
```
Benutzer-Id:    1
Passwort:       0000
```
(Sollte dies nicht funktionieren, versuchen Sie es mit der Benutzer-Id "0")