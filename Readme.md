# 🌐 SudMaps Backend API (Symfony + API Platform)

Bienvenue dans le backend de **SudMaps**, l'application qui rend les lieux accessibles dans les pays du Sud, même sans adresse formelle.

Ce projet est développé en **Symfony 7.2.25**, avec **API Platform**, **DTOs + Micro-mapper**, **PostgreSQL**, et **FrankenPHP** pour des performances modernes.

---

## ✨ Stack Technique
- Symfony 7.2.25
- API Platform
- PostgreSQL
- FrankenPHP (sans Apache/Nginx)
- Zenstruck Foundry pour les fixtures
- Doctrine ORM avec UUID
- Mapping DTO/Entity avec SymfonyCasts MicroMapper

---

## ♻️ Installation Locale

### ✅ 1. Cloner le projet
```bash
git clone https://github.com/<your-org>/sudmaps-backend.git
cd sudmaps-backend
```

### ✅ 2. Installer les dépendances
```bash
composer install
```

### ✅ 3. Créer le fichier `.env.local`
Configure la BDD PostgreSQL (Neon) :
```
DATABASE_URL="postgresql://<user>:<password>@<host>/<database>?serverVersion=15&charset=utf8"
```

---

## 🔄 Lancer le projet en local

### Ὠ0 Option A - FrankenPHP (recommandé)

#### 1. Installer FrankenPHP (manuellement)
```bash
curl https://frankenphp.dev/install.sh | sh
sudo mv frankenphp /usr/local/bin/
```

#### 2. Lancer le serveur
```bash
frankenphp php-server -r public/
```

### 🚢 Option B - Docker (alternative rapide)
```bash
docker run -v $PWD:/app/public \
  -p 443:443/tcp -p 443:443/udp \
  dunglas/frankenphp
```

> Le serveur est accessible sur : https://localhost ou https://sudmaps.pabiosoft.com

---

## 📊 Base de Données (si mode dev)

Pour initialiser la base de données :
```bash
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load --purge-with-truncate
```

---

## 🌐 Endpoints disponibles
Swagger (API Platform) dispo sur :
```
https://sudmaps.pabiosoft.com/api
```
Ou en local :
```
https://localhost/api
```

---

## 🪑 Pour le développeur mobile (React Native)

- Toutes les routes sont REST + JSON-LD (Hydra)
- Authentification (JWT) à venir peut-etre
- Documentation OpenAPI à jour
- Exemple de route :
```http
GET /api/locations
```

---

## 📁 Structure Dossier Clé
```
├── src/
│   ├── ApiResource/        # DTO exposés en API
│   ├── Entity/             # Entités Doctrine (UUID)
│   ├── Factory/            # Zenstruck Foundry Factories
│   ├── Mapper/             # MicroMappers DTO <-> Entity
│   └── State/              # API Platform Providers / Processors
├── public/                 # Dossier servi par FrankenPHP
├── config/                 # Configuration Symfony/API Platform
├── migrations/             # Migrations Doctrine
└── .env/.env.local         # Variables d'environnement
```

---


## ☕ Besoin d'aide ?
Ping nous en ouvrant une Issue GitHub ✨

---

Made with ❤️ by @pabiosoft & @civilisation-it

