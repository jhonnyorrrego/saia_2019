<?php

/*
 +-----------------------------------------------------------------------+
 | localization/<lang>/messages.inc                                      |
 |                                                                       |
 | Localization file of the Roundcube Webmail client                     |
 | Copyright (C) 2005-2015, The Roundcube Dev Team                       |
 |                                                                       |
 | Licensed under the GNU General Public License version 3 or            |
 | any later version with exceptions for skins & plugins.                |
 | See the README file for a full license statement.                     |
 |                                                                       |
 +-----------------------------------------------------------------------+

 For translation see https://www.transifex.com/projects/p/roundcube-webmail/resource/messages/
*/
$messages['errortitle']  = 'Desila se greška!';
$messages['loginfailed']  = 'Prijava nije uspjela.';
$messages['cookiesdisabled'] = 'Vaš preglednik ne prihvata kolačiće.';
$messages['sessionerror'] = 'Vaša sesija je neispravna ili je istekla.';
$messages['storageerror'] = 'Neuspješna konekcija na IMAP server';
$messages['servererror'] = 'Serverska greška!';
$messages['servererrormsg'] = 'Serverska greška: $msg';
$messages['connerror'] = 'Greška u povezivanju (Nije moguće kontaktirati server)!';
$messages['dberror'] = 'Greška u bazi podataka!';
$messages['windowopenerror'] = 'Popup prozor je blokiran!';
$messages['requesttimedout'] = 'Zahtjev je istekao';
$messages['errorreadonly'] = 'Nije moguće izvršiti operaciju. Folder je samo za čitanje.';
$messages['errornoperm'] = 'Nije moguće izvršiti operaciju. Pristup je odbijen.';
$messages['erroroverquota'] = 'Nije moguće izvršiti operaciju. Nema slobodnog prostora.';
$messages['erroroverquotadelete'] = 'Nema slobodnog prostora. Pritisnite SHIFT+DEL da obrišete poruku.';
$messages['invalidrequest'] = 'Neispravan zahtjev! Podaci nisu sačuvani.';
$messages['invalidhost'] = 'Neispravno ime servera.';
$messages['nomessagesfound'] = 'Nema poruka u ovom sandučetu.';
$messages['loggedout'] = 'Uspješno ste se odjavili. Doviđenja!';
$messages['mailboxempty'] = 'Sanduče je prazno';
$messages['nomessages'] = 'Nema poruka';
$messages['refreshing'] = 'Osvježavam...';
$messages['loading'] = 'Učitavanje...';
$messages['uploading'] = 'Dodajem datoteku...';
$messages['uploadingmany'] = 'Dodajem datoteke...';
$messages['loadingdata'] = 'Učitavanje podataka...';
$messages['checkingmail'] = 'Provjeram ima li novih poruka...';
$messages['sendingmessage'] = 'Šaljem poruku...';
$messages['messagesent'] = 'Poruka je uspješno poslana.';
$messages['savingmessage'] = 'Poruka se snima...';
$messages['messagesaved'] = 'Poruka je uspješno sačuvana u skicama.';
$messages['successfullysaved'] = 'Uspješno sačuvano.';
$messages['savingresponse'] = 'Snimam teksta odgovora...';
$messages['deleteresponseconfirm'] = 'Da li zaista želite obrisati tekst ovog odgovora?';
$messages['addedsuccessfully'] = 'Kontakt uspješno dodan u adresar.';
$messages['contactexists'] = 'Kontakt sa ovom email adresom već postoji u adresaru.';
$messages['contactnameexists'] = 'Kontakt s tim imenom već postoji.';
$messages['blockedimages'] = 'Zbog zaštite privatnosti, slike sa drugih servera su blokirane u ovoj poruci.';
$messages['encryptedmessage'] = 'Ova poruka je šifrirana i nije je moguće prikazati. Žao nam je!';
$messages['nocontactsfound'] = 'Adresar je prazan.';
$messages['contactnotfound'] = 'Traženi kontakt nije pronađen.';
$messages['contactsearchonly'] = 'Unesite neki pojam za pretragu';
$messages['sendingfailed'] = 'Greška pri slanju poruke.';
$messages['senttooquickly'] = 'Molimo sačekajte $sec sekundi prije slanja ove poruke.';
$messages['errorsavingsent'] = 'Desila se greška pri snimanju poslane poruke.';
$messages['errorsaving'] = 'Desila se greška pri snimanju.';
$messages['errormoving'] = 'Nije moguće premjestiti poruke.';
$messages['errorcopying'] = 'Nije moguće kopirati poruke.';
$messages['errordeleting'] = 'Nije moguće obrisati poruke.';
$messages['errormarking'] = 'Nije moguće označiti poruke.';
$messages['deletecontactconfirm']  = 'Da li zaista želite obrisati označene kontakte?';
$messages['deletegroupconfirm']  = 'Da li zaista želite obrisati označenu grupu?';
$messages['deletemessagesconfirm'] = 'Da li zaista želite obrisati označene poruke?';
$messages['deletefolderconfirm']  = 'Da li zaista želite obrisati ovaj folder?';
$messages['purgefolderconfirm']  = 'Da li zaista želite obrisati sve poruke u ovom folderu?';
$messages['contactdeleting'] = 'Brišem kontakte...';
$messages['groupdeleting'] = 'Brišem grupu...';
$messages['folderdeleting'] = 'Brišem folder...';
$messages['foldermoving'] = 'Premještam folder...';
$messages['foldersubscribing'] = 'Pretplaćujem se na folder...';
$messages['folderunsubscribing'] = 'Uklanjam pretplatu za folder...';
$messages['formincomplete'] = 'Obrazac nije popunjen u cjelosti.';
$messages['noemailwarning'] = 'Molimo vas da upišete ispravnu email adresu.';
$messages['nonamewarning']  = 'Molimo vas da upišete ime.';
$messages['nopagesizewarning'] = 'Molimo vas da upišete veličinu stranice.';
$messages['nosenderwarning'] = 'Molimo vas da upišete email adresu pošiljaoca';
$messages['norecipientwarning'] = 'Molimo vas da upišete barem jednog primaoca.';
$messages['nosubjectwarning']  = 'Polje \'Naslov\' je prazno. Želite li unijeti naslov?';
$messages['nobodywarning'] = 'Želite li poslati poruku bez teksta?';
$messages['notsentwarning'] = 'Poruka nije poslana. Želite li odbaciti ovu poruku?';
$messages['restoresavedcomposedata'] = 'Pronađena je prethodno napisana poruka koja nije poslana..\n\nTema:$subject\nSnimljeno: $date\n\nŽelite li vratiti ovu poruku?';
$messages['noldapserver'] = 'Molimo vas da odaberete LDAP server za pretragu.';
$messages['nosearchname'] = 'Molimo vas da upišete ime kontakta ili email adresu.';
$messages['notuploadedwarning'] = 'Neki od priloga još nisu dodani na server. Molimo vas da sačekate ili da otkažete dodavanje.';
$messages['searchsuccessful'] = 'Broj pronađenih poruka: $nr';
$messages['contactsearchsuccessful'] = '$nr kontakata je pronađeno.';
$messages['searchnomatch'] = 'Traženi pojam nije pronađen ni u jednoj poruci.';
$messages['searching'] = 'Pretražujem...';
$messages['checking'] = 'Provjeravam...';
$messages['stillsearching'] = 'I dalje pretražujem...';
$messages['nospellerrors'] = 'Pravopisne greške nisu pronađene.';
$messages['folderdeleted'] = 'Folder je uspješno obrisan.';
$messages['foldersubscribed'] = 'Uspješno ste pretplaćeni na folder.';
$messages['folderunsubscribed'] = 'Pretplata na folder je uspješno ukinuta.';
$messages['folderpurged'] = 'Folder je uspješno ispražnjen.';
$messages['folderexpunged'] = 'Folder je uspješno optimiziran.';
$messages['deletedsuccessfully'] = 'Brisanje uspješno.';
$messages['converting'] = 'Uklanjam formatiranje...';
$messages['messageopenerror'] = 'Nije moguće učitati poruku sa servera.';
$messages['fileuploaderror'] = 'Dodavanje datoteke nije uspjelo.';
$messages['filesizeerror'] = 'Datoteka je prevelika. Maksimalna veličina je $size.';
$messages['copysuccess'] = 'Uspješno kopirano $nr kontakata.';
$messages['movesuccess'] = 'Uspješno premješteno $nr kontakata.';
$messages['copyerror'] = 'Nije moguće kopirati kontakte.';
$messages['moveerror'] = 'Nije moguće premjestiti kontakte.';
$messages['sourceisreadonly'] = 'Ovaj izvor adresa je samo za čitanje.';
$messages['errorsavingcontact'] = 'Nije moguće sačuvati kontakt adresu.';
$messages['movingmessage'] = 'Premještam poruke...';
$messages['copyingmessage'] = 'Kopiram poruke...';
$messages['copyingcontact'] = 'Kopiram kontakte...';
$messages['movingcontact'] = 'Premještam kontakte...';
$messages['deletingmessage'] = 'Brišem poruke...';
$messages['markingmessage'] = 'Označavam poruke...';
$messages['addingmember'] = 'Dodajem kontakte u grupu...';
$messages['removingmember'] = 'Uklanjam kontakte iz grupe...';
$messages['receiptsent'] = 'Potvrda o primitku je uspješno poslana.';
$messages['errorsendingreceipt'] = 'Nije moguće poslati potvrdu.';
$messages['deleteidentityconfirm'] = 'Da li zaista želite obrisati ovaj identitet?';
$messages['nodeletelastidentity'] = 'Ne možete obrisati jedini identitet.';
$messages['forbiddencharacter'] = 'Naziv foldera sadrži nedozvoljeni znak.';
$messages['selectimportfile'] = 'Molimo vas da odaberete datoteku za dodavanje.';
$messages['addresswriterror'] = 'U odabrani adresar nije moguće zapisivati.';
$messages['contactaddedtogroup'] = 'Kontakti su uspješno dodani u ovu grupu.';
$messages['contactremovedfromgroup'] = 'Kontakti su uspješno uklonjeni iz ove grupe.';
$messages['nogroupassignmentschanged'] = 'Grupni zadaci nisu mijenjani.';
$messages['importwait'] = 'Uvoz u toku, molimo sačekajte...';
$messages['importformaterror'] = 'Uvoz nije uspio! Dodana datoteka nije u ispravnom formatu za uvoz podataka.';
$messages['importconfirm'] = '<b>Uspješno je uvezeno $inserted kontakata</b>';
$messages['importconfirmskipped'] = '<b>Preskočeno $skipped postojećih unosa</b>';
$messages['importmessagesuccess'] = 'Uspješno uvezeno $nr poruka';
$messages['importmessageerror'] = 'Uvoz nije uspio! Dodana datoteke nije ispravna datoteka sa porukama';
$messages['opnotpermitted'] = 'Operacija nije dozvoljena!';
$messages['nofromaddress'] = 'U odabrani identitet nije upisana email adresa.';
$messages['editorwarning'] = 'Promjenom uređivača biste mogli izgubiti formatiranje teksta. Želite li nastaviti?';
$messages['httpreceivedencrypterror'] = 'Dogodila se fatalna konfiguracijska greška. Odmah kontaktirajte administratora. <b>Vaša poruka se ne poslati.</b>';
$messages['smtpconnerror'] = 'SMTP greška ($code): Veza sa serverom nije uspostavljena.';
$messages['smtpautherror'] = 'SMTP greška ($code): Autentifikacija nije uspjela.';
$messages['smtpfromerror'] = 'SMTP greška ($code): Nije uspjelo postavljanje pošiljaoca "$from" ($msg).';
$messages['smtptoerror'] = 'SMTP greška ($code): Nije uspjelo dodavanje primaoca "$to" ($msg)';
$messages['smtprecipientserror'] = 'SMTP greška: Nije moguće pročitati listu primaoca.';
$messages['smtperror'] = 'SMTP greška: $msg';
$messages['emailformaterror'] = 'Netačna email adresa: $email';
$messages['toomanyrecipients'] = 'Previše primaoca. Smanjite broj primaoca na $max.';
$messages['maxgroupmembersreached'] = 'Broj članova grupe prelazi maksimum od $max.';
$messages['internalerror'] = 'Dogodila se interna greška. Molimo vas da pokušate ponovo.';
$messages['contactdelerror'] = 'Kontakti ne mogu biti obrisani.';
$messages['contactdeleted'] = 'Kontakti su uspješno obrisani.';
$messages['contactrestoreerror'] = 'Nije moguće vratiti obrisane kontakte.';
$messages['contactrestored'] = 'Kontakti su uspješno vraćeni.';
$messages['groupdeleted'] = 'Grupa je uspješno obrisana.';
$messages['grouprenamed'] = 'Grupa je uspješno preimenovana.';
$messages['groupcreated'] = 'Grupa je uspješno kreirana.';
$messages['savedsearchdeleted'] = 'Sačuvana pretraga je uspješno obrisana.';
$messages['savedsearchdeleteerror'] = 'Nije moguće obrisati sačuvanu pretragu.';
$messages['savedsearchcreated'] = 'Uspješno ste sačuvali rezultate pretrage.';
$messages['savedsearchcreateerror'] = 'Nije moguće sačuvati pretragu.';
$messages['messagedeleted'] = 'Poruke su uspješno obrisane.';
$messages['messagemoved'] = 'Poruke su uspješno premještene.';
$messages['messagecopied'] = 'Poruke uspješno kopirane.';
$messages['messagemarked'] = 'Poruke uspješno označene.';
$messages['autocompletechars'] = 'Unesite barem $min znakova za automatsko popunjavanje.';
$messages['autocompletemore'] = 'Pronađeno je još rezultata. Molimo vas da upišete još znakova.';
$messages['namecannotbeempty'] = 'Polje za ime ne može biti prazno.';
$messages['nametoolong'] = 'Ime je predugo.';
$messages['folderupdated'] = 'Folder je uspješno ažuriran.';
$messages['foldercreated'] = 'Folder je uspješno kreiran.';
$messages['invalidimageformat'] = 'Format slike nije ispravan.';
$messages['mispellingsfound'] = 'Pronađene su pravopisne greške u ovoj poruci.';
$messages['parentnotwritable'] = 'Nije moguće kreirati/premjestiti folder u odabrani matični folder. Nemate prava pristupa.';
$messages['messagetoobig'] = 'Dio poruke je prevelik za procesiranje.';
$messages['attachmentvalidationerror'] = 'UPOZORENJE! Ovaj prilog je sumnjiv zbog toga što se njegov tip ne poklapa s tipom navedenim u poruci. Ako nemate povjerenja u pošiljaova, ne biste trebali da otvarate ovaj prilog u vašem browseru jer bi on mogao da sadrži zlonamjerni sadržaj.<br/><br/><em>Očekivano: $expected; pronađeno: $detected</em>';
$messages['noscriptwarning'] = 'Upozorenje! Ovom webmail servisu je potreban Javascript! Da biste ga mogli koristiti, prvo je potrebno da omogućite Javascript u postavkama vašeg browsera.';
?>