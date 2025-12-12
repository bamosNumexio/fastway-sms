# Fastway SMS PHP SDK

Ce package est un SDK PHP simple permettant d’envoyer des SMS et de consulter le solde Fastway SMS via leur API REST.

Il vous permet d’intégrer l’envoi de SMS dans n’importe quel projet PHP **en quelques lignes seulement**.

---

## Prérequis

Avant d’utiliser ce SDK, vous devez :

1. Avoir un compte Fastway SMS valide : [https://fastway-sms.net/](https://fastway-sms.net/#)
2. Récupérer vos identifiants (username et password) depuis votre espace client Fastway.

Autres prérequis techniques :

- PHP ≥ 7.4
- cURL activé

---

## Installation

Installez le package avec Composer :

```bash
composer require numexio/fastway-sms
```

Assurez-vous ensuite d’inclure l’autoload :

```php
require 'vendor/autoload.php';
```

---

## Configuration & Initialisation

Pour utiliser le SDK, commencez par créer une instance du client :

```php
use FastwaySms\FastwaySms;

$sms = new FastwaySms("VOTRE_USERNAME", "VOTRE_PASSWORD");
```

**Où trouver votre username et password ?**
Ils vous sont fournis par Fastway SMS dans votre espace client.

---

# Comment utiliser le SDK ?

## Envoyer un SMS

Voici l’exemple minimum :

```php
$response = $sms->send(
    "229XXXXXXXX",     // Numéro du destinataire
    "Votre message ici"
);
```

### Définir l’expéditeur (optionnel)

Vous pouvez ajouter un nom d’expéditeur personnalisé :

```php
$response = $sms->send(
    "229XXXXXXXX",
    "Bonjour, ceci est un test.",
    "NUMEXIO"
);
```

### Réponse obtenue

Le SDK retourne un tableau :

```php
[
    "status" => 200,            // Code HTTP, 200 = OK
    "response" => "{...json...}" // Réponse brute envoyée par Fastway
]
```

---

## Vérifier votre solde

Pour connaître le nombre de SMS restants :

```php
$balance = $sms->checkBalance();
print_r($balance);
```

### Exemple de réponse

```php
[
    "status" => 200,
    "response" => "{\"balance\": 150}"
]
```

---

# Résumé des méthodes disponibles

| Méthode                                   | Description                      |
| ----------------------------------------- | -------------------------------- |
| `send($to, $text, $from = "SMS-FASTWAY")` | Envoi un SMS                     |
| `checkBalance()`                          | Récupère votre solde Fastway SMS |

---

# Exemple complet (copier/coller)

```php
require 'vendor/autoload.php';

use FastwaySms\FastwaySms;

$sms = new FastwaySms("USERNAME", "PASSWORD");

// ENVOYER UN SMS
$send = $sms->send(
    "22901234567",
    "Hello depuis Fastway SDK !",
    "NUMEXIO"
);

echo "Résultat envoi : \n";
print_r($send);

// Vérifier solde
$balance = $sms->checkBalance();
echo "\nSolde disponible : \n";
print_r($balance);
```

---

# Structure du projet

```
fastway-sms/
│
├── composer.json
├── README.md
└── src/
    └── FastwaySms.php
```

---

# Licence

MIT License.

---

# Auteur

Développé par **Numexio**
API & Solutions logicielles professionnelles.
