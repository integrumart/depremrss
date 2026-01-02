=== Deprem RSS ===
Contributors: integrumart
Tags: deprem, earthquake, rss, feed, türkiye
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.0.0
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Depremleri WordPress sitenizde takip edin - RSS beslemesi üzerinden deprem verilerini görüntüleyin.

== Description ==

Deprem RSS, WordPress sitenizde deprem verilerini RSS feed üzerinden takip etmenizi sağlayan güçlü bir eklentidir. KOERI ve diğer deprem veri kaynaklarından gelen bilgileri sitenizde kolayca gösterebilirsiniz.

= Özellikler =

* **RSS Feed Desteği**: Herhangi bir deprem RSS feed'ini kullanabilirsiniz
* **Özelleştirilebilir Görünüm**: Gösterilecek deprem sayısını ve minimum büyüklüğü ayarlayın
* **Shortcode Desteği**: `[deprem_listesi]` shortcode'u ile istediğiniz yerde deprem listesi gösterin
* **Widget Desteği**: Yan menüde deprem widget'ı ekleyin
* **Otomatik Yenileme**: Sayfa yenilenmeden deprem listesini otomatik güncelleyin
* **Önbellekleme**: Performans için RSS feed'i önbelleğe alır
* **Renk Kodlu Büyüklük**: Deprem büyüklüğüne göre renkli görünüm
* **Duyarlı Tasarım**: Mobil ve masaüstü cihazlarda mükemmel görünüm

= Kullanım =

1. Eklentiyi yükleyin ve etkinleştirin
2. Ayarlar → Deprem RSS'den ayarları yapılandırın
3. RSS feed URL'sini girin (örn: KOERI feed)
4. Shortcode kullanın: `[deprem_listesi]`
5. Veya Widget ekleyin: Görünüm → Widget'lar

= Shortcode Örnekleri =

Temel kullanım:
`[deprem_listesi]`

5 deprem göster:
`[deprem_listesi count="5"]`

Minimum 3.0 büyüklüğündeki depremleri göster:
`[deprem_listesi min_magnitude="3.0"]`

Hem sayı hem büyüklük filtresi:
`[deprem_listesi count="10" min_magnitude="2.5"]`

= Widget Kullanımı =

1. Görünüm → Widget'lar menüsüne gidin
2. "Deprem RSS Widget"ı istediğiniz alana sürükleyin
3. Widget ayarlarını yapılandırın
4. Kaydedin

== Installation ==

= Otomatik Kurulum =

1. WordPress yönetim panelinde Eklentiler → Yeni Ekle'ye gidin
2. "Deprem RSS" araması yapın
3. "Şimdi Yükle" butonuna tıklayın
4. Eklentiyi etkinleştirin

= Manuel Kurulum =

1. depremrss.zip dosyasını indirin
2. WordPress yönetim panelinde Eklentiler → Yeni Ekle → Eklenti Yükle'ye gidin
3. Zip dosyasını seçin ve yükleyin
4. Eklentiyi etkinleştirin

= FTP ile Kurulum =

1. depremrss.zip dosyasını çıkartın
2. `depremrss` klasörünü `/wp-content/plugins/` dizinine yükleyin
3. WordPress yönetim panelinde eklentiyi etkinleştirin

== Frequently Asked Questions ==

= Hangi RSS feed kaynaklarını kullanabilirim? =

KOERI (Kandilli Rasathanesi) ve diğer standart RSS formatındaki deprem feed'lerini kullanabilirsiniz. Önerilen kaynak: http://www.koeri.boun.edu.tr/scripts/lst0.asp

= Veriler ne sıklıkla güncellenir? =

Ayarlarda belirlediğiniz önbellek süresine göre veriler güncellenir. Varsayılan olarak 5 dakikadır. Ayrıca manuel olarak "Yenile" butonuna basarak da güncelleyebilirsiniz.

= Otomatik yenileme nasıl çalışır? =

Otomatik yenileme özelliği etkinleştirildiğinde, belirlediğiniz aralıklarla (varsayılan 60 saniye) sayfa yenilenmeden deprem listesi AJAX ile güncellenir.

= Widget ve shortcode aynı anda kullanılabilir mi? =

Evet, istediğiniz kadar widget ve shortcode kullanabilirsiniz. Her birini farklı parametrelerle özelleştirebilirsiniz.

= Mobil uyumlu mu? =

Evet, eklenti tam responsive (duyarlı) tasarıma sahiptir ve tüm cihazlarda mükemmel görünür.

== Screenshots ==

1. Deprem listesi görünümü
2. Yönetim paneli ayarları
3. Widget ayarları
4. Shortcode kullanımı

== Changelog ==

= 1.0.0 =
* İlk sürüm
* RSS feed desteği
* Shortcode desteği
* Widget desteği
* Otomatik yenileme
* Önbellekleme sistemi
* Duyarlı tasarım
* Türkçe arayüz

== Upgrade Notice ==

= 1.0.0 =
İlk sürüm - yeni özellikler ve iyileştirmeler.

== Additional Info ==

Bu eklenti açık kaynak kodludur ve GPL v2 lisansı altında dağıtılmaktadır. Katkıda bulunmak için GitHub deposunu ziyaret edin:
https://github.com/integrumart/depremrss

Destek için issue açabilir veya pull request gönderebilirsiniz.
