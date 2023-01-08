
# ADISE21_WelcomeToTheJungle

 **QUARTO GAME BY**
  **~~THANASIS KAREZOS~~**
  **~~PERIKLIS CHRISTOS GOUSIOS~~**

Το project που υλοποιηθηκε αναφερεται στο μαθημα Ανάπτυξη Διαδικτυακών Συστημάτων και Εφαρμογών του Τμήματος Μηχανικών Πληροφορικής και Ηλεκτρονικών Συστημάτων ΔΙΠΑΕ.

Αναφερεται σε ενα Board Game ονοματο Quarto.

Απαιτήσεις

 - Apache2 
 - Mysql Server 
 - php 
 - PostMan   [[https://www.postman.com/](https://www.postman.com/)]

## Demo Page
Μπορείτε να επισκεφτείτε την σελίδα [https://users.it.teithe.gr/~it185193/adise/api/v1/index.php/showboard](https://users.it.teithe.gr/~it185193/adise/api/v1/index.php/showboard) και να παίξετε την τελευταία έκδοση του παιχνιδιού.  
Σημείωση : πρέπει να πατήσετε το start button πριν κάνετε login στο παιχνίδι για να ξεκινήσει.  
Προσοχή : το start button πρέπει να πατηθεί μόνο μια φορά και μόνο από έναν browser, στην συνέχεια μπορούν να συνδεθούν οι παίκτες.


# **Οδηγίες Εγκατάστασης**

 - Κάντε clone το project σε κάποιον φάκελο $ git clone 
   [https://github.com/iee-ihu-gr-course1941/ADISE21_WelcomeToTheJungle.git]

 - Βεβαιωθείτε ότι ο φάκελος είναι προσβάσιμος από τον Apache Server.
   πιθανόν να χρειαστεί να καθορίσετε τις παρακάτω ρυθμίσεις.


 - Θα πρέπει να δημιουργήσετε στην Mysql την βάση με όνομα 'Board' και να
   φορτώσετε σε αυτήν την βάση τα δεδομένα από το αρχείο schema.sql
   
  

 - Θα πρέπει να φτιάξετε το αρχείο ../../db_upass.php το οποίο να   
   περιέχει:

    

>     <?php
>     if(!defined('Access'))
>      {
>     die('Direct access not permitted');
>     }
>     $DB_PASS = '';
>     $DB_USER = 'root';
>     ?>


# **Περιγραφή Παιχνιδιού**

Το Quarto είναι ένα επιτραπέζιο παιχνίδι για δύο παίκτες που εφευρέθηκε από τον Ελβετό μαθηματικό Blaise Müller.

Το παιχνίδι παίζεται σε ταμπλό 4×4. Υπάρχουν 16 μοναδικά κομμάτια για να παίξετε, καθένα από τα οποία είναι είτε:

> Long or Short  
> White or Brown  
> Square or Cycle  
> With leak or not

Οι παίκτες διαλέγουν ένα κομμάτι το οποίο πρέπει να τοποθετήσει ο άλλος παίκτης στο ταμπλό. Ένας παίκτης κερδίζει τοποθετώντας ένα κομμάτι στον πίνακα που σχηματίζει μια οριζόντια, κάθετη ή διαγώνια σειρά τεσσάρων κομματιών, τα οποία έχουν όλα μια κοινή ιδιότητα (όλα κοντά, όλα κυκλικά κ.λπ.).

## **Συντελεστές**

 **θανασης Καρεζος : Jquery , Σχεδιασμός mysql  
Περικλης Χρηστος Γουσιος: Jquery , Σχεδιασμός mysql**

Περιγραφή API

Methods

```
Εισοδος Login 
POST / LOGIN 
Καθορισμός στοιχείων παίκτη
```
```
Δημιουργία Register 
POST / Register 
Εγραφη του χρηστη
```
```
Ελεγχος Checkstatus 
GET / checkstatus 
Επιστροφη το στατους του παιχνιδιου
```
```
Εμφανιση Showboard 
GET / showboard 
Εμφανιση του πινακα Board
```
```
Εμφανιση Showpieces 
GET / showpieces 
Εμφανιση τον διαθεσημων πιονιων
```
```
Τοποθετηση Place  
POST / PLACE  		
Βαζει το πιονι που
επιλεχτικε στην θεση που θελει ο χρηστης
```
```
Επιλογη Pick 
POST / pick 
Επιλεγει ο χρηστης το πιονι του αντιπαλου
```
```
Τοποθετηση JoinGame 
POST / joinGame
Προσθετει τον χρηστη στο παιχνιδι
```
```
Επαναφορα ResetGame
POST / resetGame 
Επαναφερει το παιχνιδι στην θεση 0
```
## **Board** 
Το board είναι ένας πίνακας, ο οποίος στο κάθε στοιχείο έχει τα παρακάτω:
|Attribute | Description | Values|
|--|--|--|
| x | H συντεταγμένη x του τετραγώνου |1..4 
| y|H συντεταγμένη y του τετραγώνου |1..4
|piece |To Πιόνι που υπάρχει στο|1...16, null

## **Pieces**
| Attribute | Description |Values |
|--|--|--|
|pieceID |   Μοναδικός αριθμός| 1...16
|piececolor | Άν είναι λευκό η μαύρο | 'Black','White'
|shape|Αν είναι στρόγγυλο η τετράγωνο |cycle','square
|size|Αν είναι κοντό η ψηλό |'short','long' 
|hole|Αν έχει βαθουλωτή κορυφή ή συμπαγής κορυφή| 'YES','NO'
|available|Είδος κίνησης που πρέπει να κάνει ο παίκτης|'TRUE','FALSE'

## **Users** 
O κάθε παίκτης έχει τα παρακάτω στοιχεία:
| Attribute  |Description   |	Values  |
|--|--|--|
| ID  | Μόναδικος άυξων αριθμος |ΙΝΤ INCREMENT
|username |  Όνομα παίκτη|String,UNIQUE
|  email |email παικτη|String,UNIQUE
|password | Κωδικος παικτη |String
|token| To κρυφό token του παίκτη|String,UNIQUE
 HEX' pick','place' token. timestamp

## **Game_status**
| Attribute  | Description  |Values |
|--|--|--|
| status  | Κατάσταση  |'not active', 'initialized', 'started', 'ended', 'aborded'|
|turn |  Η κατασταση που καθοριζεται ο παιχτης |TINYINT(1,2) 
|state |κατασταση παιχτη| pick or place 
|piece |αποθηκευειτο πιονι που επαιξε και επελεξε να παιξει ο καθε παιχτης (κραταει ενα log file το οποιο δειχνει την καθε κινηση)  |1...16
|change |προσθηκη χρονου |timestamp
|won |δηλωνει οταν το status_game γινει end game ποιος νικησε|text


## Players
| Attribute  | Description  |Values |
|--|--|--|
|player|Μόναδικος άυξων αριθμος|int auto_increment
|id|Το id που παιρνει ο παίκτης στον πινακα users|int(10)
|username|Όνομα παίκτη|text,UNIQUE
|token|To κρυφό token του παίκτη|text,UNIQUE
