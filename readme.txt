=== Deprem RSS ===
Contributors: integrumart
Tags: deprem, earthquake, rss, feed, türkiye, turkey, kandilli, koeri
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.0.0
Requires PHP: 7.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

WordPress için Türkiye'deki son depremleri takip etmenizi sağlayan RSS eklentisi.

== Description ==

Deprem RSS eklentisi, Türkiye'deki son depremleri WordPress sitenizde göstermenizi ve RSS feed olarak sunmanızı sağlar.

= Özellikler =

* RSS feed desteği
* Kolay yönetim paneli
* Shortcode ile sayfa/yazılara entegrasyon
* Widget desteği
* Önbellekleme sistemi
* Minimum büyüklük filtresi
* Özelleştirilebilir görünüm
* Türkçe dil desteği

= RSS Feed =

Eklenti aktif edildiğinde deprem verileri şu adresten erişilebilir:
`https://siteniz.com/feed/deprem`

= Shortcode Kullanımı =

Basit kullanım:
`[depremrss]`

Parametreli kullanım:
`[depremrss limit="10" min_magnitude="4.0"]`

= Widget =

Görünüm > Widget'lar menüsünden "Deprem RSS Widget" ekleyebilirsiniz.

== Installation ==

1. Eklentiyi `wp-content/plugins/` dizinine yükleyin
2. WordPress yönetim panelinden eklentiyi aktif edin
3. "Deprem RSS" menüsünden ayarları yapılandırın

== Frequently Asked Questions ==

= Deprem verileri nereden alınıyor? =

Eklenti varsayılan olarak Kandilli Rasathanesi ve Deprem Araştırma Enstitüsü (KOERI) verilerini kullanacak şekilde yapılandırılmıştır.

= Önbellek ne kadar süreyle tutulur? =

Varsayılan olarak 5 dakika (300 saniye). Bu süreyi ayarlar sayfasından değiştirebilirsiniz.

= Sadece büyük depremleri gösterebilir miyim? =

Evet, minimum büyüklük ayarını kullanarak filtreleme yapabilirsiniz.

= RSS feed'i nasıl kullanabilirim? =

RSS feed URL'sini (https://siteniz.com/feed/deprem) RSS okuyucularınıza ekleyebilirsiniz.

== Screenshots ==

1. Yönetim paneli
2. Deprem listesi (shortcode)
3. Widget görünümü
4. RSS feed

== Changelog ==

= 1.0.0 =
* İlk sürüm yayınlandı
* RSS feed desteği
* Shortcode desteği
* Widget desteği
* Yönetim paneli
* Türkçe dil desteği

== Upgrade Notice ==

= 1.0.0 =
İlk sürüm.
