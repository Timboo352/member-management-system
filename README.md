# Installationsanleitung
Führen Sie innerhalb von "/app/" folgendes aus:
```
npm install
```
```
npm run build
```

Anschliessend können sie im obersten Verzeichnis des Projektes folgendes ausführen:
```
docker compose up
```
Nun sollte sich unter [localhost:8080](http://localhost:8080) ein schönes Login-Formular öffnen<br>
Wenn Sie nun [localhost:8080/init](http://localhost:8080/init) aufrufen, wird eine erste Rolle, ein erstes Mitglied und ein erster App-Benutzer angelegt.<br>
Danach können Sie sich mit den folgenden Daten anmelden:
```
Benutzer-Id:    1
Passwort:       0000
```
(Sollte dies nicht funktionieren, versuchen Sie es mit der Benutzer-Id "0")