# Quiz ΑΣΕΠ

Εφαρμογή Quiz γνώσεων για τον διαγωνισμό ΑΣΕΠ, φτιαγμένη με Laravel 11 και Bootstrap 5.

## Χαρακτηριστικά

- 📚 **12 κατηγορίες** ερωτήσεων (330+ ερωτήσεις)
- 🎯 **Quiz mode** — χρονομετρημένο quiz με αποτελέσματα
- 📖 **Study mode** — μελέτη με σωστές απαντήσεις highlighted
- 🏆 **Leaderboard** — πίνακας επιδόσεων με podium
- 👤 **User profiles** — διαχείριση λογαριασμού
- 📱 **Responsive** — δουλεύει σε desktop, tablet, mobile

## Κατηγορίες

- Συνταγματικό Δίκαιο
- Διοικητικό Δίκαιο
- Πληροφορική & Ψηφιακή Διακυβέρνηση
- GDPR
- Κώδικας Συμπεριφοράς Δημοσίων Υπαλλήλων
- Ευρωπαϊκοί Θεσμοί και Δίκαιο
- Οικονομικές Επιστήμες
- Σύγχρονη Ιστορία της Ελλάδας
- Κώδικας Κατάστασης Πολιτικών Διοικητικών Υπαλλήλων
- Διοίκηση Επιχειρήσεων και Οργανισμών
- Διοίκηση Ανθρώπινου Δυναμικού

## Τεχνολογίες

- **Backend**: Laravel 11, PHP 8.4
- **Frontend**: Bootstrap 5.3, Alpine.js 3, Vite 8
- **Database**: MySQL
- **Auth**: Laravel Breeze

## Εγκατάσταση

### Απαιτήσεις

- PHP 8.2+
- Composer
- Node.js 20+
- MySQL

### Βήματα

```bash
# Clone
https://github.com/gregvlahokostas-dev/quiz-ndgv.git
cd quiz-asep

# Dependencies
composer install
npm install

# Environment
cp .env.example .env
php artisan key:generate

# Database (ρύθμισε το .env πρώτα)
php artisan migrate
php artisan db:seed --class=QuizSeeder

# Build
npm run build

# Run
php artisan serve
