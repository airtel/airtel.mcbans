<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/**
 * Jūsu ID no statistikas sistēmas, var redzēt statistikas augšdaļā, vai Profila
 * sadaļā
 */
$config['user_id'] = '1';


/**
 * Jūsu passkey no statistikas sistemas, var atrast Profila sadaļā
 */
$config['passkey'] = '';


/**
 * Jūsu atslēgas vārds, ja neesat pasūtījuši atsevišķu, tad šim jāpaliek tādam
 * kāds tas ir. 
 */
$config['base_keyword'] = 'ART';


/**
 * Īsais numurs uz kuru sūtam SMS.
 * ART atslēgas vārdam tas ir 1800
 */
$config['short_number'] = '1800';


/**
 * Pieejamie apmaksas veidi
 */
$config['minecraft_payments'] = array('sms', 'ibank', 'paypal');


/**
 * Jābut FALSE ja vēlaties pelnīt naudu. Citādak kodi netiek realizēti, bet tikai pārbaudīti.
 * Atbilde tiek saņemta nevis code_charged_ok bet code_test_ok.
 * Varam slēgt iekšā ja vēlamies tikai pārbaudīt skripta darbību.
 */
$config['testing'] = TRUE;


/**
 * Aplikācijai ir iepsēja ieslēgt iframe mode, tas nozīmē, ka veikals tiks pieladēts bez lieka koda.
 * Nebūs header, footer atstarpju, kā arī shop tiks maksimāli nobīdīts pie augšējā kreisā stūra.
 * Tiks pieslēgts jQuery kods, kurš atbild par atsaucīgu veikala reaģēšanu uz augstuma izmaiņām.
 */
$config['iframe_mode'] = FALSE;


/**
 * Minecraft tabulas nosaukums.
 */
$config['bans_table'] = 'banlist';


/**
 * Minecraft ban noņemšanas cena.
 */
$config['unban_price'] = array(
  
    'sms' => '200',         // SMS kods
    'paypal' => '3.00',     // Cena EUR
    'ibank' => '2.00',      // Cena LVL
    
);