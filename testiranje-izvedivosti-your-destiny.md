# Testiranje Izvedivosti - Your Destiny

## Konfiguracija Prikaza Poreza
**Izvedivost: VISOKA**

### Implementacija:
WooCommerce > Postavke > Porez > "Prikaži cijene u trgovini" postavi na "Bez poreza"
"Prikaži cijene tijekom košarice i naplate" postavi na "S uključenim porezom"
Omogući opcije "Omogući izračunavanje poreza" i "Prikaži ukupne poreze"

## Mjesečni Izvještaji Prodaje po Zemljama
**Izvedivost: SREDNJA**

### Opcije:
**WooCommerce Analitika + Proširenja:**
- WooCommerce Admin (sada dio jezgre) pruža osnovnu analitiku
- Potrebno prilagođeno proširenje ili izvještaj za mjesečni pregled po zemljama

**Rješenja treće strane za izvještavanje:**
- "Metorik" - Napredna WooCommerce analitika ($20-200/mjesečno)
- "Advanced WooCommerce Reporting" plugin (~$49)

**Prilagođeno rješenje za izvještavanje:**
- Razvijanje prilagođenog widget-a za nadzornu ploču koristeći WP_Query i WC_Order objekte
- Spremanje podataka o porezu u meta podatke narudžbe za lako dohvaćanje

### Primjer koda za prilagođeni izvještaj:

```php
function country_sales_report() {
    $year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
    $months = range(1, 12);
    $countries = array();
    
    foreach ($months as $month) {
        $args = array(
            'post_type' => 'shop_order',
            'post_status' => 'wc-completed',
            'date_query' => array(
                array(
                    'year' => $year,
                    'month' => $month,
                ),
            ),
            'posts_per_page' => -1,
        );
        
        $orders = new WP_Query($args);
        
        if ($orders->have_posts()) {
            while ($orders->have_posts()) {
                $orders->the_post();
                $order = wc_get_order(get_the_ID());
                $country = $order->get_billing_country();
                
                if (!isset($countries[$country])) {
                    $countries[$country] = array_fill(0, 12, 0);
                }
                
                $countries[$country][$month-1] += $order->get_total();
            }
        }
        wp_reset_postdata();
    }
    
    // Generiraj HTML/CSV izvještaj
}
```

## PDF Računi s Informacijama o Porezu
**Izvedivost: VISOKA**

### Preporučena rješenja:
**"WooCommerce PDF Invoices & Packing Slips" (Besplatno/Premium €99)**
- Prilagodljivi predlošci
- Dodavanje stope poreza i informacija o zemlji u predložak

**"PDF Invoices for WooCommerce" by WebToffee ($69)**
- Naprednije funkcionalnosti
- Bolje rukovanje informacijama o porezu

### Koraci implementacije:
1. Instaliraj i aktiviraj željeni plugin
2. Konfiguriraj PDF predloške da uključuju:
   - Primijenjenu stopu poreza
   - Zemlju kupca
   - Razloženi prikaz izračuna poreza
3. Postavi automatsko generiranje po završetku narudžbe

## 2. NEWSLETTER POPUP S NAGRADAMA

### Analiza Zahtjeva
- Stvori popup koji nudi pretplatu na newsletter
- Pruži besplatno PDF preuzimanje uz pretplatu
- Generiraj jedinstveni jednokratni kod popusta (20%)
- Pošalji automatiziran dobrodošli e-mail s PDF-om i kuponom

## Tehnička Izvedivost

### Implementacija Newsletter Popup-a
**Izvedivost: VISOKA**

### Opcije implementacije:
**Integracija e-mail marketinga:**
- Mailchimp for WooCommerce (Besplatno)
- ActiveCampaign for WooCommerce
- Oba nude funkcionalnost popup-a i automatizaciju

**Dedicirani popup pluginovi:**
- "Popup Maker" (Besplatno/Premium $87/godišnje)
- "OptinMonster" ($9-49/mjesečno)
- "Hustle" (Besplatno/Premium)

### Preporučeni pristup:
Koristi integrirano rješenje poput Mailchimp + "MC4WP: Mailchimp for WordPress"
- Stvori prilagođeni dizajn popup-a s formom za pretplatu
- Spoji na automatizacijski workflow za isporuku

### Generiranje Jedinstvenih Kupona
**Izvedivost: SREDNJE-VISOKA**

### Opcije implementacije:
**Rješenje prilagođenim kodom:**
- Priključi se na predaju forme pretplate
- Generiraj jedinstveni kupon s WC_Coupon klasom
- Postavi usage_limit = 1 i individual_use = true
- Spremi kod kupona u korisničke meta podatke ili tagove e-mail servisa

**Plugin rješenja:**
- "Advanced Coupons for WooCommerce" (Besplatno/Premium $69-199)
- "WooCommerce Smart Coupons" ($99)

### Primjer koda za generiranje prilagođenih kupona:

```php
function generate_unique_subscriber_coupon($email) {
    $coupon_code = 'NEWS' . substr(md5(uniqid($email, true)), 0, 8);
    
    $coupon = new WC_Coupon();
    $coupon->set_code($coupon_code);
    $coupon->set_discount_type('percent');
    $coupon->set_amount(20); // 20% popust
    $coupon->set_individual_use(true);
    $coupon->set_usage_limit(1);
    $coupon->set_email_restrictions(array($email));
    $coupon->set_date_expires(strtotime('+30 days'));
    $coupon->save();
    
    return $coupon_code;
}

// Priključi se na događaj predaje forme
add_action('mc4wp_form_subscribed', 'process_newsletter_subscription', 10, 3);
function process_newsletter_subscription($form, $args, $subscriber) {
    $email = $subscriber['EMAIL'];
    $coupon = generate_unique_subscriber_coupon($email);
    
    // Spremi za slanje e-maila
    update_option('subscriber_coupon_' . md5($email), $coupon);
    
    // Pokreni slanje e-maila (ovisno o vašem e-mail sustavu)
    send_welcome_email($email, $coupon);
}
```

### Automatizirani Dobrodošli E-mail s Prilozima
**Izvedivost: SREDNJE-VISOKA**

### Opcije implementacije:
**Automatizacija platforme za e-mail marketing:**
- Postavi Mailchimp/ActiveCampaign automatizacijski workflow
- Uključi PDF prilog ili link za preuzimanje
- Umetni dinamički kod kupona u e-mail predložak

**WordPress/WooCommerce prilagođeni e-mail:**
- Stvori prilagođeni e-mail predložak
- Koristi wp_mail() s prilozima
- Pokreni na predaju forme

### Razmotrenja implementacije:
- **Spremanje PDF datoteke:** Spremi u zaštićenu media mapu s kontrolom pristupa
- **Isporučivost e-maila:** Razmotriti SMTP servis poput SendGrid
- **Praćenje:** Dodaj parametre praćenja u linkove za preuzimanje

## POSTAVLJANJE LOKALNOG TESTIRANJA

### Postavljanje Okruženja
**Instaliraj lokalno WordPress okruženje:**
- Local by Flywheel
- XAMPP/MAMP
- Docker s WordPress kontejnerom

**Osnovna konfiguracija:**
- WordPress najnovija verzija
- WooCommerce najnovija verzija
- Primjerski digitalni proizvodi

### Testiranje Poreznog Sustava
**Konfiguriraj testne porezne stope:**
- Dodaj nekoliko poreznih stopa država (npr. Hrvatska, EU zemlje, SAD)
- Postavi različite stope za testiranje

**Testiranje geolokacije:**
- **Opcija 1:** Koristi browser ekstenziju poput "ModHeader" za simuliranje IP-a
- **Opcija 2:** Modificiraj WooCommerce geolocation funkciju za testiranje:

```php
add_filter('woocommerce_geolocate_ip', function($ip_address) {
    // Forsiraj određenu zemlju za testiranje
    return array(
        'country' => 'US', // Promijeni za testiranje različitih zemalja
        'state' => 'NY',
    );
});
```

**Testiraj izračun poreza:**
- Stvori testne narudžbe iz različitih "lokacija"
- Provjeri je li primijenjen točan porez na temelju zemlje
- Provjeri prikaz poreza u košarici i naplati

**Testiraj generiranje PDF-a:**
- Završi testne narudžbe
- Provjeri generiranje PDF-a s točnim informacijama o porezu
- Provjeri isporuku računa putem e-maila

### Testiranje Newsletter Sustava
**Konfiguracija e-maila za lokalno testiranje:**
- Instaliraj "WP Mail SMTP" plugin
- Konfiguriraj sa servisom poput Mailtrap.io za testiranje
- Ili koristi Gmail SMTP za lokalno testiranje

**Testiraj proces pretplate:**
- Pošalji newsletter formu
- Provjeri generiranje kupona
- Provjeri isporuku e-maila s PDF-om i kodom kupona

**Testiraj korištenje kupona:**
- Koristi generirani kod kupona
- Provjeri je li primijenjen 20% popust
- Potvrdi da se kupon može koristiti samo jednom

## POTREBNI PLUGINOVI I RESURSI

### Osnovni zahtjevi
- WordPress (najnovija verzija)
- WooCommerce (najnovija verzija)

### Upravljanje porezima
- WooCommerce PDF Invoices & Packing Slips
- Opcionalno: GeoIP Detection plugin
- Opcionalno: Prilagođeni kod za potvrdu lokacije

### Newsletter i kupon sustav
- Mailchimp for WooCommerce
- MC4WP: Mailchimp for WordPress
- ILI ActiveCampaign + AC for WooCommerce
- WP Mail SMTP (za testiranje)
- Opcionalno: Advanced Coupons for WooCommerce

### Izvještavanje
- WooCommerce Admin (ugrađeno)
- Opcionalno: Metorik ili prilagođeno rješenje za izvještavanje

## PROCIJENJENI NAPOR IMPLEMENTACIJE

- **Osnovno WooCommerce postavljanje:** 2-4 sata
- **Konfiguracija poreza:** 2-3 sata
- **Geolokacija i potvrda:** 4-6 sati
- **Prilagodba PDF računa:** 2-3 sata
- **Newsletter popup:** 3-4 sata
- **Sustav generiranja kupona:** 4-5 sati
- **Konfiguracija e-maila:** 2-3 sata
- **Testiranje i otklanjanje grešaka:** 6-8 sati

**Ukupno procijenjeno sati: 25-36 sati**

## ZAKLJUČAK

Oba zahtjeva su tehnički izvodljiva unutar WooCommerce ekosustava s različitim stupnjevima složenosti:

**Sustav upravljanja porezima** je vrlo izvodljiv s minimalnim prilagođenim kodom, koristeći ugrađene WooCommerce mogućnosti i dodajući PDF funkcionalnost kroz etablirane pluginove.

**Newsletter popup s nagradama** je umjereno složen, ali ostvariv kombinacijom integracije e-mail marketinga i prilagođene logike generiranja kupona.

Za optimalnu implementaciju, kombinacija osnovnih WooCommerce značajki, etabliranih pluginova i ciljanih prilagođenih kodova pružit će najefikasniju soluciju uz osiguravanje održivosti.